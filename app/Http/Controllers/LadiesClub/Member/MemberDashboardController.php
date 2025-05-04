<?php

namespace App\Http\Controllers\LadiesClub\Member;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\BloodGroup;
use App\Models\Club;
use App\Models\Event;
use App\Models\MembershipInformation;
use App\Models\Notice;
use App\Models\Rank;
use App\Models\SpouseInformation;
use App\Models\Unit;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $member = DB::table('users')
            ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->select('users.*', 'spouse_information.*')
            ->where('users.id', Auth::user()->id)
            ->first();
        $paymentDue = $this->totalAmountOfDue();
        if (!empty($paymentDue) && !empty($this->lastPaymentDate())) {
            $lastPayment = Carbon::parse($this->lastPaymentDate()->pay_month);
        } else {
            $lastPayment = null;
        }
        //$date = Carbon::parse($this->lastPaymentDate()->pay_month);
        //$lastPayment = $date->format('M-Y');
        //dd($lastPayment);
        $paymentMonth = DB::table('member_payments')
            ->select('pay_month', 'pay_amount')
            ->where('user_id', Auth::id()) // Shorter version of Auth::user()->id
            ->get();
        if (!empty($paymentMonth)) {
            $formattedData = $paymentMonth->map(function ($payment) {
                return [
                    'pay_month' => Carbon::parse($payment->pay_month)->format('d-M-Y'), // Example: 25-Feb-2025
                    'pay_amount' => $payment->pay_amount
                ];
            });

            $pay_month_array = $formattedData->pluck('pay_month')->toArray();
            $pay_amount_array = $formattedData->pluck('pay_amount')->toArray();
        } else {
            $pay_month_array = null;
            $pay_amount_array = null;
        }
        return view('ladiesClub.member.dashboard', [
            'member' => $member,
            'paymentDue' => $paymentDue,
            'lastPayment' => $lastPayment,
            'pay_month' => $pay_month_array,
            'pay_amount' => $pay_amount_array
        ]);
    }

    public function memberProfile()
    {
        $member = DB::table('users')
            ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->join('ranks', 'ranks.id', '=', 'spouse_information.rank_id')
            ->join('blood_groups', 'users.blood_group_id', '=', 'blood_groups.id')
            ->join('units', 'spouse_information.unit_id', '=', 'units.id')
            ->join('user_images', 'users.id', '=', 'user_images.user_id')
            ->select(
                'users.*',
                'spouse_information.*',
                'membership_information.membership_date',
                'membership_information.id_card_number',
                'ranks.name as rank_name',
                'blood_groups.group_name',
                'units.unit_name_en',
                'user_images.member_image',
                'user_images.member_signature'
            )
            ->where('users.id', Auth::user()->id)
            ->first();
        return view('ladiesClub.memberProfile.profile', [
            'member' => $member
        ]);
    }

    public function memberPayBill()
    {
        $payPerMonth = \DB::table('member_monthly_payable_amounts')->select('member_monthly_payable_amounts.monthly_payable_amount')
            ->where('user_id', Auth::user()->id)->first();
        $membershipInfo = \DB::table('membership_information')
            ->select('membership_date', 'expiry_date', 'status')
            ->where('user_id', Auth::user()->id)
            ->first();
        $lastPayment = $this->lastPaymentDate();
        $totalMonthsDue = $this->totalMonthOfDue();
        $totalAmountOfDue = $this->totalAmountOfDue();
        //dd($totalAmountOfDue);
        return view('ladiesClub.payment.payBill', [
            'payPerMonth' => $payPerMonth,
            'membershipInfo' => $membershipInfo,
            'totalMonthsDue' => $totalMonthsDue,
            'totalAmountOfDue' => $totalAmountOfDue,
            'lastPayment' => $lastPayment
        ]);
    }

    private function lastPaymentDate()
    {
        $lastPayment = DB::table('member_payments')
            ->select('*')
            ->where('user_id', Auth::user()->id)
            ->latest('id')->first();
        //dd($lastPayment);
        return $lastPayment;
    }

    private function totalMonthOfDue()
    {
        $lastPayment = $this->lastPaymentDate();
        if (!empty($lastPayment)) {
            $startDate = Carbon::parse($lastPayment->pay_month);
        } else {
            $previousMonthDate = Carbon::now()->subMonth();
            $startDate = Carbon::parse($previousMonthDate->format('Y-m-d'));
        }
        //dd($startDate);
        $endDate = Carbon::parse(date('Y-m-d'));
        $totalMonthsDue = $startDate->diffInMonths($endDate);
        return $totalMonthsDue;
    }

    private function totalAmountOfDue()
    {
        $monthlyPay = DB::table('member_monthly_payable_amounts')->select('monthly_payable_amount')->where('user_id', Auth::user()->id)->first();
        //dd($monthlyPay);
        if (!empty($monthlyPay)) {
            $totalAmountOfDue = (int)$monthlyPay->monthly_payable_amount * $this->totalMonthOfDue();
        } else {
            $totalAmountOfDue = null;
        }

        return $totalAmountOfDue;
    }

    public function makePayment(Request $request)
    {
        $validatedData = $request->validate([
            'pay_amount' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,jpg,png,jpeg,gif|max:5120',
            'ref_no' => 'nullable',
        ]);
        $fileName = ($request->get('member_id') ?? 'unknown') . '_' . date('Y-m-d');
        if ($request->file('file')) {
            $memberPaySlip = makeImage($request->file('file'), $fileName, 'memberPaySlip', 400, 400);
        } else {
            $memberPaySlip = null;
        }
        //dd($memberPaySlip);

        DB::table('member_payments')
            ->insert([
                'user_id' => $request->member_id,
                'pay_month' => date('Y-m-d'),
                'pay_amount' => $request->pay_amount,
                'document' => $memberPaySlip,
                'ref_no' => $request->ref_no,
                'is_active' => 1
            ]);

        return redirect()->back();
    }

    public function memberNotice()
    {
        $notices = Notice::select('id', 'title', 'title_bn', 'notice_date', 'description', 'description_bn', 'attachment', 'status')->where('club_id', 2)->where('area_id', Auth::user()->area_id)->get();
        //dd($notices);
        return view('ladiesClub.memberProfile.notice', [
            'notices' => $notices
        ]);
    }

    public function memberNoticeView($id)
    {
        $notice = Notice::findOrFail($id);
        return view('ladiesClub.memberProfile.noticeView', [
            'notice' => $notice
        ]);
    }
    public function generateUniqueCode()
    {
        // Loop until a unique 4-digit code is found
        do {
            // Generate a random 4-digit number (between 1000 and 9999)
            $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (DB::table('member_attend_events')->where('event_code', $code)->exists());

        // If a unique code is found, return it
        return $code;
    }
    public function memberAttendEvent(Request $request, $id)
    {
        $request->validate([
            'selectedOption' => 'required|in:0,1',
        ]);
        $userId = Auth::id();
        $phone = Auth::user()->phone;
        $selectedOption = (int) $request->input('selectedOption');
        $code = '';
        if($selectedOption == 1){
            $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $message = "Your verification code is: {$code}. Please use this code to attend the event.";
            $phone = Auth::user()->phone;
            $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
                'username' => 'ITDAHQAdmin_3753',
                'password' => 'ITdte@2020',
                'apicode' => '1',
                'countrycode' => '880',
                'cli' => 'IT DTE',
                'msisdn' => $phone,
                'messagetype' => '1',
                'message' => $message,
                'messageid' => '0'
            ]);
            if ($response->successful()) {
                \Log::info('SMS sent successfully', ['to' => $phone]);
            } else {
                \Log::error('SMS failed', [
                    'to' => $phone,
                    'response' => $response->body(),
                    'status' => $response->status()
                ]);
            }
        }
        $data = [
            'user_id' => $userId,
            'event_id' => $id,
            'member_phone_number' => $phone,
            'member_will_attend' => $selectedOption,
            'event_code' => $code,
            'created_at' => now()->format('Y-m-d'),
        ];

        // Insert or update member attendance
        $updated = DB::table('member_attend_events')->updateOrInsert(
            ['user_id' => $userId, 'event_id' => $id],
            $data
        );

        // Update event table only if attendance was recorded
        if ($updated) {
            DB::table('events')
                ->where('id', $id)
                ->update(['is_attend' => $selectedOption]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Data accepted successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.'
        ]);
    }

    public function memberEvent()
    {
        //$events = Event::select('id', 'title_bn', 'event_date', 'description_bn', 'status', 'is_attend')->where('club_id', 2)->where('area_id', Auth::user()->area_id)->get();
        $events = \DB::table('events')
            ->leftJoin('member_attend_events', function($join) {
                $join->on('events.id', '=', 'member_attend_events.event_id')
                    ->where('member_attend_events.user_id', Auth::user()->id);
            })
            ->select(
                'events.id',
                'events.title_bn',
                'events.event_date',
                'events.description_bn',
                'events.status',
                'events.is_attend',
                'member_attend_events.member_will_attend'
            )
            ->where('events.club_id', 2)
            ->where('events.area_id', Auth::user()->area_id)
            ->get();
        //dd($events);
        return view('ladiesClub.memberProfile.event', [
            'events' => $events
        ]);
    }

    public function memberEventView($id)
    {
        $event = Event::findOrFail($id);
        return view('ladiesClub.memberProfile.eventView', [
            'event' => $event
        ]);
    }

    public function memberGallery()
    {
        dd("Member Gallery");
    }

    public function memberPayment()
    {
        $payHistory = DB::table('member_payments')
            ->select('member_payments.*')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('ladiesClub.payment.payment_history', [
            'payHistory' => $payHistory
        ]);
    }

    public function memberChangePassword()
    {
        return view('ladiesClub.memberProfile.change_password');
    }

    public function updatePassword(Request $request)
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
        $user = User::findOrFail(auth()->id());
        if (!$user) {
            abort(404, 'User not found');
        }
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function uodateProfile()
    {
        $id = Auth::user()->id;
        $member = DB::table('users')
            ->leftJoin('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->leftJoin('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->select(
                'users.id',
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
        return view('ladiesClub.memberProfile.update_profile', [
            'bloodGroup' => $bloodGroup,
            'clubs' => $clubs,
            'areas' => $areas,
            'ranks' => $ranks,
            'units' => $units,
            'member' => $member
        ]);
    }

    public function uodateSave(Request $request)
    {
        $id = Auth::user()->id;
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
            'membership_no' => 'required|numeric'
        ]);
        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'name_bn' => $request->name_bn,
                'email' => $request->email,
                'phone' => $request->phone,
                'blood_group_id' => $request->blood_group_id,
                'membership_no' => $request->membership_no,
            ]);

            $spouseInfo->update([
                'user_id' => $user->id,
                'spouse_name_en' => $request->spouse_name_en,
                'spouse_name_bn' => $request->spouse_name_bn,
                'spouse_ba_no' => $request->spouse_ba_no,
                'rank_id' => $request->rank_id,
                'unit_id' => $request->unit_id,
                'spouse_phone_number' => $request->spouse_phone_number
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
            //            $membershipInfo->update([
            //                'user_id' => $user->id,
            //                'membership_date' => Carbon::today(),
            //                'expiry_date' => $request->expiry_date,
            //                'membership_no' => $request->membership_no,
            //                'id_card_number' => $this->generateCode(),
            //                'status' => 1
            //            ]);
            //dd("HERE3");
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            return redirect()->back();
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

    public function uodateProfilePicture()
    {
        return view('ladiesClub.memberProfile.update_profile_picture');
    }

    public function uodateProfilePictureSave(Request $request)
    {
        $validatedData = $request->validate([
            'profile_image' => 'required|mimes:jpg,png,jpeg|max:5120'
        ]);
        $userId = Auth::user()->id;
        $fileName = $userId . '_' . Auth::user()->name;
        if ($request->file('profile_image')) {
            $userImage = makeImage($request->file('profile_image'), $fileName, 'memberImage', 300, 300);
        } else {
            $userImage = null;
        }
        DB::beginTransaction();
        try {
            DB::table('users')->where('id', $userId)->update([
                'image' => $userImage
            ]);
            DB::table('user_images')->where('user_id', $userId)->update([
                'member_image' => $userImage
            ]);
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            return redirect()->back();
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

    public function uodateSignature()
    {
        return view('ladiesClub.memberProfile.update_signature');
    }

    public function uodateSignatureSave(Request $request)
    {
        $validatedData = $request->validate([
            'signature' => 'required|mimes:jpg,png,jpeg|max:5120'
        ]);
        $userId = Auth::user()->id;
        $fileName = $userId . '_' . Auth::user()->name;
        if ($request->file('signature')) {
            $userSignature = makeImage($request->file('signature'), $fileName, 'memberSignature', 300, 80);
        } else {
            $userSignature = null;
        }
        DB::beginTransaction();
        try {
            DB::table('user_images')->where('user_id', $userId)->update([
                'member_signature' => $userSignature
            ]);
            DB::commit();
            notify()->success('Application Successfully done', 'success');
            return redirect()->back();
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
}
