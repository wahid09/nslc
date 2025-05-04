<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\BanglaDate;
use App\Models\Area;
use App\Models\Club;
use App\Models\Page;
use App\Models\sobanetry;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SobanetryController extends Controller
{
    public $banglaDate;
    public function __construct()
    {
        $this->banglaDate = new BanglaDate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('leader-index');
        $leaders = sobanetry::getLeaders();
        //return $leaders;
        $areas = Area::active()->get();
        //return $areas;
        return view('backend.leaders.index', compact('leaders', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('leader-create');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        $appointments = Appointment::active()->get();
        //$users = User::select('id', 'name', 'name_bn')->get();
        // $users = DB::table('users')
        //     ->whereNotIn('id', function ($query) {
        //         $query->select('user_id')->from('sobanetries'); // Exclude users in sobanetry
        //     })
        //     ->where('status', 1)
        //     ->select('id', 'name', 'name_bn')
        //     ->toSql();
        $users = User::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('sobanetries')
                ->whereRaw('sobanetries.user_id = users.id');
        })
            ->where('status', 1)
            ->select('id', 'name', 'name_bn')
            ->get();
        return view('backend.leaders.form', compact('pages', 'areas', 'appointments', 'users'));
    }
    public function getUserList(Request $request)
    {
        if ($request->get('club_id') && $request->get('area_id')) {
            // $users = DB::table('users')
            //     ->whereNotIn('id', function ($query) {
            //         $query->select('user_id')->from('sobanetries'); // Exclude users in sobanetry
            //     })
            //     ->where('club_id', $request->get('club_id'))
            //     ->where('area_id', $request->get('area_id'))
            //     ->where('status', 1)
            //     ->select('id', 'name', 'name_bn')
            //     ->get();
            $users = User::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('sobanetries')
                    ->whereRaw('sobanetries.user_id = users.id');
            })
                ->where('status', 1)
                ->select('id', 'name', 'name_bn')
                ->get();
        } else {
            abort(404, 'User not found');
        }
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('leader-create');
        //return $request;
        $this->validate($request, [
            'appointment' => 'required',
            'club' => 'required',
            'area_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $date = date('d M Y', strtotime($request->appoint_in));
        $date = $this->banglaDate->bn_date_time($date);
        //return $date;
        if (!empty($request->appoint_out)) {
            $date_out = date('d M Y', strtotime($request->appoint_out));
            $date_out = $this->banglaDate->bn_date($date_out);
        } else {
            $date_out = '';
        }

        //return $date_out;

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('leader/')) {
                Storage::disk('public')->makeDirectory('leader/');
            }
            $makImage = Image::make($image)->resize(512, 489)->stream();
            Storage::disk('public')->put('leader/' . $imageName, $makImage);
        } else {
            $imageName = "";
        }
        // if (is_numeric($request->seniority_order)) {
        //     $seniorityOrder = $request->seniority_order;
        // } else {
        //     notify()->success("Seniority Order will be numeric value", "error");
        // }
        if ($request->get('user_id')) {
            $userName = User::findOrFail($request->get('user_id'))->value('name_bn');
        } else {
            $userName = null;
        }
        $leaders = sobanetry::create([
            'appointment_id' => $request->appointment,
            'club_id' => $request->club,
            'page_id' => 1,
            'area_id' => $request->area_id,
            'description_bn' => $request->description_bn,
            'name_bn' => $userName,
            'seniority_order' => $request->seniority_order,
            'image' => $imageName,
            'appoint_in' => $date,
            'appoint_out' => $date_out,
            'status' => $request->filled('status'),
            'user_id' => $request->get('user_id')
        ]);

        notify()->success("Leader Added", "Success");
        return redirect()->route('app.leader.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, sobanetry $sobanetry)
    {
        Gate::authorize('leader-update');
        $sobanetry = sobanetry::findOrFail($id);
        //dd($sobanetry);
        $pages = Club::getClubs();
        $areas = Area::getArea();
        $users = User::select('id', 'name', 'name_bn')->get();
        $appointments = Appointment::all();
        return view('backend.leaders.form', compact('pages', 'sobanetry', 'areas', 'appointments', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('leader-update');
        //return $request;
        $sobanetry = sobanetry::findOrFail($id);
        $this->validate($request, [
            'appointment' => 'required',
            'club' => 'required',
            'area_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (!empty($request->appoint_in)) {
            $date = date('d M Y', strtotime($request->appoint_in));
            $date = $this->banglaDate->bn_date($date);
        } else {
            $date = $sobanetry->appoint_in;
        }

        if (!empty($request->appoint_out)) {
            $date_out = date('d M Y', strtotime($request->appoint_out));
            $date_out = $this->banglaDate->bn_date($date_out);
        } else {
            $date_out = $sobanetry->appoint_out;
        }

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('leader/')) {
                Storage::disk('public')->makeDirectory('leader/');
            }
            $makImage = Image::make($image)->resize(512, 489)->stream();
            Storage::disk('public')->put('leader/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('leader/' . $sobanetry->image)) {
                Storage::disk('public')->delete('leader/' . $sobanetry->image);
            }
        }

        if (empty($imageName) && !empty($sobanetry->image)) {
            $imageName = $sobanetry->image;
        }
        // if (is_numeric($request->seniority_order)) {
        //     $seniorityOrder = $request->seniority_order;
        // } else {
        //     notify()->success("Seniority Order will be numeric value", "error");
        // }
        if ($request->get('user_id')) {
            $userName = User::findOrFail($request->get('user_id'))->value('name_bn');
        } else {
            $userName = null;
        }
        $sobanetry->update([
            'appointment_id' => $request->appointment,
            'club_id' => $request->club,
            'page_id' => $request->club,
            'area_id' => $request->area_id,
            'description_bn' => $request->description_bn,
            'name_bn' => $userName,
            'seniority_order' => $request->seniority_order,
            'image' => $imageName,
            'appoint_in' => $date,
            'appoint_out' => $date_out,
            'status' => $request->filled('status'),
            'user_id' => $request->get('user_id')
        ]);

        notify()->success("Leader Updated", "Success");
        return redirect()->route('app.leader.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, sobanetry $sobanetry)
    {
        Gate::authorize('leader-delete');
        $sobanetry = sobanetry::findOrFail($id);
        if (Storage::disk('public')->exists('leader/' . $sobanetry->image)) {
            Storage::disk('public')->delete('leader/' . $sobanetry->image);
        }
        $sobanetry->delete();
        notify()->success("Leader Deleted", "Success");
        return back();
    }
}
