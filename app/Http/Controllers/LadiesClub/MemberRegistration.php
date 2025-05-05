<?php

namespace App\Http\Controllers\LadiesClub;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\BloodGroup;
use App\Models\Club;
use App\Models\Device;
use App\Models\MemberMonthlyPayableAmount;
use App\Models\MembershipInformation;
use App\Models\Rank;
use App\Models\SpouseInformation;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class MemberRegistration extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('lcm-index');
        return view('ladiesClub.registration.index');
    }

    public function getMembersData(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('users')
                ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
                ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
                ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
                ->select(
                    'users.id as user_id',
                    'users.club_id',
                    'users.name as member_name',
                    'users.phone as member_phone',
                    'users.email',
                    'users.status as user_status',
                    'spouse_information.spouse_name_en as spouse_name_en',
                    'spouse_information.spouse_ba_no as spouse_ba_no',
                    'membership_information.id_card_number',
                    'membership_information.membership_no as membership_no',
                    'ranks.id',
                    'ranks.name as rank_name'
                )
                ->where('users.area_id', Auth::user()->area_id)
                ->where('users.club_id', Auth::user()->club_id)
                ->orderBy('ranks.id', 'ASC');
//            if ($request->area_id !== null) {
//                $query->where('users.area_id', $request->input('area_id', Auth::user()->area_id));
//            }
            //dd($query->toSql());
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('membership_no', function ($data) {
                    return $data->membership_no ?? '';
                })
                ->addColumn('spouse_name_en', function ($data) {
                    return $data->spouse_name_en ?? '';
                })
                ->addColumn('spouse_ba_no', function ($data) {
                    return $data->spouse_ba_no ?? '';
                })
                ->addColumn('rank_name', function ($data) {
                    return $data->rank_name ?? '';
                })
                ->addColumn('member_name', function ($data) {
                    return $data->member_name ?? '';
                })
                ->addColumn('email', function ($data) {
                    return $data->email ?? '';
                })
                ->addColumn('member_phone', function ($data) {
                    return $data->member_phone ?? '';
                })
                ->addColumn('id_card_number', function ($data) {
                    return $data->id_card_number ?? '';
                })
                ->addColumn('status', function ($row) {
                    return $row->user_status ? '<span class="badge badge-info">Active</span>' : '<span class="badge badge-warning">Inactive</span>';
                })
                ->addColumn('actions', function ($row) {
                    $viewBtn = '<a href="' . route('app.member.view', $row->user_id) . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
                    $assignBtn = '<a href="' . route('app.user.assignDeviceForm', $row->user_id) . '" class="btn btn-primary btn-sm"><i class="fa fa-tablet"></i></a>';
                    $editBtn = '<a href="' . route('app.member-registration.edit', $row->user_id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<button type="button" data-id="' . $row->user_id . '" class="btn btn-danger btn-sm delete-member" title="delete member"><i class="fas fa-trash"></i></button>';
                    return $viewBtn . ' ' . $assignBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->filterColumn('membership_no', function ($query, $keyword) {
                    $query->where('users.membership_no', 'like', "%{$keyword}%");
                })
                ->filterColumn('id_card_number', function ($query, $keyword) {
                    $query->where('membership_information.id_card_number', 'like', "%{$keyword}%");
                })
                ->filterColumn('spouse_ba_no', function ($query, $keyword) {
                    $query->where('spouse_information.spouse_ba_no', 'like', "%{$keyword}%");
                })
                ->filterColumn('member_name', function ($query, $keyword) {
                    $query->where('users.name', 'like', "%{$keyword}%");
                })
                ->filterColumn('email', function ($query, $keyword) {
                    $query->where('users.email', 'like', "%{$keyword}%");
                })
                ->filterColumn('member_phone', function ($query, $keyword) {
                    $query->where('users.phone', 'like', "%{$keyword}%");
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('lcm-create');
        $bloodGroup = BloodGroup::active()->select('id', 'group_name')->get();
        $clubs = Club::active()->select('id', 'name')->get();
        $areas = Area::active()->select('id', 'name')->get();
        $ranks = Rank::active()->select('id', 'name')->get();
        $units = Unit::active()->select('id', 'unit_name_en')->get();
        return view('ladiesClub.registration.form', [
            'bloodGroup' => $bloodGroup,
            'clubs' => $clubs,
            'areas' => $areas,
            'ranks' => $ranks,
            'units' => $units
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('lcm-create');
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'name_bn' => 'nullable|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'blood_group_id' => 'required|integer|min:1',
            'phone' => ['required', new PhoneNumber],
            'area_id' => 'required',
            'spouse_name_en' => 'required|string|min:3',
            'spouse_name_bn' => 'nullable|string|min:3',
            'spouse_ba_no' => 'required|numeric|min:4',
            'unit_id' => 'required',
            'rank_id' => 'required',
            'spouse_phone_number' => ['required', new PhoneNumber],
            'expiry_date' => 'required',
            'membership_no' => 'required|numeric'
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'name_bn' => $request->name_bn,
                'email' => $request->email,
                'role_id' => 2,
                'password' => Hash::make('12345678'),
                'status' => 0,
                'area_id' => $request->area_id,
                'club_id' => 1,
                'phone' => $request->phone,
                'blood_group_id' => $request->blood_group_id,
                'membership_no' => $request->membership_no,
                'status' => $request->filled('status'),
                'is_ladies_club_member' => 1
            ]);
            //Member Pamyment calculation
            if (!empty($request->get('rank_id'))) {
                if ($request->get('rank_id') >= 9) {
                    $monthlyPayAmount = '250';
                }
                if ($request->get('rank_id') == 8) {
                    $monthlyPayAmount = '300';
                }
                if ($request->get('rank_id') == 7) {
                    $monthlyPayAmount = '350';
                }
                if ($request->get('rank_id') == 6) {
                    $monthlyPayAmount = '450';
                }
                if ($request->get('rank_id') <= 5) {
                    $monthlyPayAmount = '500';
                }

            } else {
                $monthlyPayAmount = null;
            }
            $payAmount = \DB::table('member_monthly_payable_amounts')
                ->insert([
                    'user_id' => $user->id,
                    'monthly_payable_amount' => $monthlyPayAmount
                ]);
            $spousInfo = SpouseInformation::create([
                'user_id' => $user->id,
                'spouse_name_en' => $request->spouse_name_en,
                'spouse_name_bn' => $request->spouse_name_bn,
                'spouse_ba_no' => $request->spouse_ba_no,
                'rank_id' => $request->rank_id,
                'unit_id' => $request->unit_id,
                'spouse_phone_number' => $request->spouse_phone_number,
                'is_active' => 1
            ]);
//            //Image Upload
//            if ($request->file('member_image')) {
//                $userImage = makeImage($request->file('member_image'), $request->name, 'memberImage', 300, 300);
//            } else {
//                $userImage = null;
//            }
//            if ($request->file('member_signature')) {
//                $userSignature = makeImage($request->file('member_signature'), $request->name, 'memberSignature', 300, 80);
//            } else {
//                $userSignature = null;
//            }
//            $userImage = UserImage::create([
//                'user_id' => $user->id,
//                'member_image' => $userImage,
//                'member_signature' => $userSignature,
//                'is_active' =>1
//            ]);
            $membershipInfo = MembershipInformation::create([
                'user_id' => $user->id,
                'membership_date' => Carbon::today(),
                'expiry_date' => $request->expiry_date,
                'membership_no' => $request->membership_no,
                'id_card_number' => $this->generateCode(),
                'status' => 1
            ]);
            //dd("HERE3");
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            return redirect()->route('app.member-registration.index');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            Log::error('Transaction Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['transaction' => 'An error occurred while storing data.'])
                ->withInput();
        }
    }

    public function updateMemberImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            // Process image
            $userImage = null;
            if ($request->hasFile('image')) {
                $userImage = makeImage($request->file('image'), $request->name ?? 'member', 'memberImage', 300, 300);
            }

            // Update DB
            DB::table('user_images')->updateOrInsert(
                ['user_id' => $id],
                ['member_image' => $userImage]
            );
            DB::table('users')->where('id', $id)->update([
                'image' => $userImage
            ]);
            return response()->json(['message' => 'Member image updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function updateMemberSignature(Request $request, $id)
    {
        $request->validate([
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            // Process image
            $userImage = null;
            if ($request->hasFile('signature')) {
                $userImage = makeImage($request->file('signature'), $request->name ?? 'member', 'memberSignature', 300, 80);
            }

            // Update DB
            DB::table('user_images')->updateOrInsert(
                ['user_id' => $id],
                ['member_signature' => $userImage]
            );
            return response()->json(['message' => 'Member Signature updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('lcm-edit');
        $member = DB::table('users')
            ->leftJoin('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->leftJoin('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->select('users.id',
                'users.name as user_name',
                'users.name_bn as user_name_bn',
                'users.phone as member_phone',
                'users.email as email',
                'users.status as user_status',
                'users.area_id',
                'users.club_id',
                'users.ba_no',
                'users.phone as member_phone',
                'users.blood_group_id',
                'spouse_information.id as si_id',
                'spouse_information.spouse_name_en',
                'spouse_information.spouse_name_bn',
                'spouse_information.spouse_ba_no',
                'spouse_information.rank_id',
                'spouse_information.unit_id',
                'spouse_information.spouse_phone_number',
                'membership_information.id as mi_id',
                'membership_information.membership_date',
                'membership_information.expiry_date',
                'membership_information.id_card_number',
                'membership_information.membership_no'
            )
            ->where('users.id', $id)
            ->first();
        //dd($member);
        $bloodGroup = BloodGroup::active()->select('id', 'group_name')->get();
        $clubs = Club::active()->select('id', 'name')->get();
        $areas = Area::active()->select('id', 'name')->get();
        $ranks = Rank::active()->select('id', 'name')->get();
        $units = Unit::active()->select('id', 'unit_name_en')->get();
        return view('ladiesClub.registration.form', [
            'bloodGroup' => $bloodGroup,
            'clubs' => $clubs,
            'areas' => $areas,
            'ranks' => $ranks,
            'units' => $units,
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('lcm-edit');
        $user = User::where('id', $id)->first();
        $spouseInfo = SpouseInformation::where('user_id', $id)->first();
        $membershipInfo = MembershipInformation::where('user_id', $id)->first();
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'name_bn' => 'nullable|string|min:3',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'blood_group_id' => 'required|integer|min:1',
            'phone' => ['required', new PhoneNumber],
            'spouse_name_en' => 'required|string|min:3',
            'spouse_name_bn' => 'nullable|string|min:3',
            'spouse_ba_no' => 'required|numeric|min:4',
            'unit_id' => 'required',
            'rank_id' => 'required',
            'spouse_phone_number' => ['required', new PhoneNumber],
            'expiry_date' => 'required',
            'membership_no' => 'required|numeric'
        ]);
        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'name_bn' => $request->name_bn,
                'email' => $request->email,
                'role_id' => 2,
                'password' => Hash::make('12345678'),
                'status' => 0,
                'area_id' => 1,
                'club_id' => 2,
                'phone' => $request->phone,
                'blood_group_id' => $request->blood_group_id,
                'membership_no' => $request->membership_no,
                'status' => $request->filled('status')
            ]);

            $spouseInfo->update([
                'user_id' => $user->id,
                'spouse_name_en' => $request->spouse_name_en,
                'spouse_name_bn' => $request->spouse_name_bn,
                'spouse_ba_no' => $request->spouse_ba_no,
                'rank_id' => $request->rank_id,
                'unit_id' => $request->unit_id,
                'spouse_phone_number' => $request->spouse_phone_number,
                'is_active' => 1
            ]);
//            //Image Upload
//            if ($request->file('member_image')) {
//                $userImage = makeImage($request->file('member_image'), $request->name, 'memberImage', 300, 300);
//            } else {
//                $userImage = null;
//            }
//            if ($request->file('member_signature')) {
//                $userSignature = makeImage($request->file('member_signature'), $request->name, 'memberSignature', 300, 80);
//            } else {
//                $userSignature = null;
//            }
//            $userImage = UserImage::create([
//                'user_id' => $user->id,
//                'member_image' => $userImage,
//                'member_signature' => $userSignature,
//                'is_active' =>1
//            ]);
            $membershipInfo->update([
                'user_id' => $user->id,
                'membership_date' => Carbon::today(),
                'expiry_date' => $request->expiry_date,
                'membership_no' => $request->membership_no,
                'id_card_number' => $this->generateCode(),
                'status' => 1
            ]);
            //dd("HERE3");
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            return redirect()->route('app.member-registration.index');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            Log::error('Transaction Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['transaction' => 'An error occurred while storing data.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('lcm-delete');
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            // Delete related records if they exist
            SpouseInformation::where('user_id', $id)->delete();
            MembershipInformation::where('user_id', $id)->delete();
            UserImage::where('user_id', $id)->delete();
            MemberMonthlyPayableAmount::where('user_id', $id)->delete();

            // Finally delete the user
            $user->delete();
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Member and related information deleted successfully.'
        ]);
    }

    public function memberApplicationFrom()
    {
        $clubs = Club::active()->select('id', 'name')->get();
        $areas = Area::active()->select('id', 'name')->get();
        $ranks = Rank::active()->select('id', 'name')->get();
        $bloodGroups = BloodGroup::active('id', 'group_name')->select()->get();
        $units = Unit::active()->select('id', 'unit_name_en')->get();
        return view('ladiesClub.applicationForm.form', [
            'clubs' => $clubs,
            'areas' => $areas,
            'ranks' => $ranks,
            'bloodGroups' => $bloodGroups,
            'units' => $units
        ]);
    }

    public function memberApplicationProcess(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'name_bn' => 'nullable|string|min:3',
            'member_ba_no' => 'nullable|numeric|min:3|unique:users,ba_no',
            'member_email' => 'required|email|unique:users,email',
            'blood_group_id' => 'required|integer|min:1',
            'member_phone_no' => ['required', new PhoneNumber],
            'spouse_name_en' => 'required|string|min:3',
            'spouse_name_bn' => 'nullable|string|min:3',
            'spouse_ba_no' => 'required|numeric|min:4',
            'unit_id' => 'required',
            'rank_id' => 'required',
            'area_id' => 'required',
            'spouse_phone_number' => ['required', new PhoneNumber],
            'member_image' => 'required',
            'member_signature' => 'required'
        ]);
        DB::beginTransaction();
        try {
            //Image Upload
            if ($request->file('member_image')) {
                $userImage = makeImage($request->file('member_image'), $request->name, 'memberImage', 300, 300);
            } else {
                $userImage = null;
            }
            if ($request->file('member_signature')) {
                $userSignature = makeImage($request->file('member_signature'), $request->name, 'memberSignature', 300, 80);
            } else {
                $userSignature = null;
            }
            $user = User::create([
                'name' => $request->name,
                'name_bn' => $request->name_bn,
                'email' => $request->member_email,
                'role_id' => 2,
                'password' => Hash::make('12345678'),
                'status' => 0,
                'area_id' => $request->area_id,
                'club_id' => 2,
                'ba_no' => $request->member_ba_no,
                'phone' => $request->member_phone_no,
                'blood_group_id' => $request->blood_group_id,
                'is_ladies_club_member' => 1,
                'membership_no' => $request->member_ba_no,
                'image' => $userImage
            ]);
            $spousInfo = SpouseInformation::create([
                'user_id' => $user->id,
                'spouse_name_en' => $request->spouse_name_en,
                'spouse_name_bn' => $request->spouse_name_bn,
                'spouse_ba_no' => $request->spouse_ba_no,
                'rank_id' => $request->rank_id,
                'unit_id' => $request->unit_id,
                'spouse_phone_number' => $request->spouse_phone_number,
                'is_active' => 1
            ]);
            //Member Pamyment calculation
            if (!empty($request->get('rank_id'))) {
                if ($request->get('rank_id') >= 9) {
                    $monthlyPayAmount = '250';
                }
                if ($request->get('rank_id') == 8) {
                    $monthlyPayAmount = '300';
                }
                if ($request->get('rank_id') == 7) {
                    $monthlyPayAmount = '350';
                }
                if ($request->get('rank_id') == 6) {
                    $monthlyPayAmount = '450';
                }
                if ($request->get('rank_id') <= 5) {
                    $monthlyPayAmount = '500';
                }

            } else {
                $monthlyPayAmount = null;
            }
            $payAmount = \DB::table('member_monthly_payable_amounts')
                ->insert([
                    'user_id' => $user->id,
                    'monthly_payable_amount' => $monthlyPayAmount
                ]);
            $userImage = UserImage::create([
                'user_id' => $user->id,
                'member_image' => $userImage,
                'member_signature' => $userSignature,
                'is_active' => 1
            ]);
            $membershipInfo = MembershipInformation::create([
                'user_id' => $user->id,
                'membership_date' => Carbon::today(),
                'expiry_date' => Carbon::today()->addYears(2),
                'membership_no' => $request->spouse_ba_no,
                'id_card_number' => $this->generateCode(),
                'status' => 1
            ]);
            //dd("HERE1");
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            //return redirect()->route('application.form');
            return redirect()->route('login');
        } catch (\Exception $e) {
            //throw $e;
            DB::rollBack();
            Log::error('Transaction Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['transaction' => 'An error occurred while storing data.'])
                ->withInput();
        }
    }

    public function generateCode()
    {
        $randomNumber = mt_rand(0, 9999999999);
        $code = str_pad($randomNumber, 10, '0', STR_PAD_LEFT);
        return $code;
    }

    public function MemberView($id)
    {
        $member = \DB::table('users')
            ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
            ->join('user_images', 'users.id', '=', 'user_images.user_id')
            ->join('clubs', 'users.club_id', '=', 'clubs.id')
            ->join('blood_groups', 'users.blood_group_id', '=', 'blood_groups.id')
            ->join('units', 'spouse_information.unit_id', '=', 'units.id')
            ->select('users.id as user_id',
                'users.name as member_name',
                'users.name_bn as member_name_bn',
                'users.email as member_email',
                'users.phone as member_phone',
                'users.status as user_status',
                'spouse_information.*',
                'membership_information.*',
                'ranks.id as Rank_id',
                'ranks.name as rank_name',
                'user_images.member_image',
                'user_images.member_signature',
                'clubs.name as club_name',
                'blood_groups.group_name',
                'units.unit_name_en'
            )
            ->where('users.id', $id)
            ->first();
        //dd($member);
        $lastPayDate = \DB::table('member_payments')
            ->select('pay_month')->where('user_id', $id)->latest('id')->first();
        //dd($lastPayDate);
        return view('ladiesClub.member.memberView', [
            'member' => $member,
            'lastPayDate' => $lastPayDate
        ]);
    }

    public function idCardNoUpdate(Request $request, $id)
    {
        $cardNo = \DB::table('membership_information')
            ->select('id_card_number')
            ->where('user_id', $id)
            ->where('id_card_number', $request->get('cardNo'))
            ->first();
        if ($cardNo) {
            return response()->json([
                'message' => 'Similar card Number Found for You!',
            ]);
        } else {
            \Illuminate\Support\Facades\DB::table('membership_information')
                ->where('user_id', $id)
                ->update([
                    'id_card_number' => $request->get('cardNo')
                ]);
            return response()->json([
                'message' => 'Card Number Updated Successfully!',
            ]);
        }
    }

    public function updateMemberPassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ], [
            'password.required' => 'New password is required',
            'password.min' => 'New password needs to have at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
            'password_confirmation.required' => 'Confirmation password is required',
            'password_confirmation.min' => 'Confirmation password needs to have at least 8 characters'
        ]);

        // Retrieve the authenticated user
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found!',
            ]);
        }
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'password Updated Successfully!',
        ]);
    }

    public function assignDeviceForm($id)
    {
        $memberInfo = \DB::table('users')
            ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.membership_no',
                'users.ba_no',
                'users.area_id',
                'users.club_id',
                'membership_information.id_card_number'
            )
            ->where('users.id', $id)
            ->first();
        $devices = Device::where('status', 1)->select('id', 'device_name')->get();
        $assignDevices = DB::table('user_assign_devices')->where('user_id', $id)->get()->toArray();
        return view('ladiesClub.member.userAssignDevice', [
            'memberInfo' => $memberInfo,
            'devices' => $devices,
            'assignDevices' => $assignDevices
        ]);
    }

    public function assignDeviceSave(Request $request)
    {
        //dd($request->all());
        $rfid = $request->get('rfid');
        $userId = $request->get('user_id');
//        $devices = "'" .implode(',', $request->get('device')). "'";
//        $devices = is_string($devices) ? explode(',', $devices) : $devices;
//        dd($devices);
        $devices = $request->get('device');
        //dd($devices);
        $clubId = $request->get('club_id');
        $areaId = $request->get('area_id');
//        $assignDevice = DB::table('user_assign_devices')
//            ->select('user_assign_devices.*')
//            ->where('user_id', $userId)
//            ->whereIn('device_id', $devices)
//            ->get();
//        dd($assignDevice);
        $data = [];
        foreach ($devices as $deviceId) {
            $data[] = [
                'user_id' => $userId,
                'id_card_number' => $rfid,
                'device_id' => $deviceId,
                'club_id' => $clubId,
                'area_id' => $areaId,
                'status' => 1,
                'created_at' => Date("Y-m-d H:i:s"),
                'updated_at' => Date("Y-m-d H:i:s"),
            ];
        }

// Perform upsert
        DB::table('user_assign_devices')->upsert(
            $data, // Data to insert/update
            ['user_id', 'device_id'], // Unique columns to check for existing records
            ['device_id'] // Columns to update if a match is found
        );

        notify()->success("Education Activites Updated", "Success");
        return redirect()->back();
    }
}
