<?php

namespace App\Http\Controllers\Backend;

use App\Models\Club;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('user-index');
        $userId = Auth::user()->id;
        $areaId = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        if (permission() == 'visitor') {
            $users = User::with('area', 'role', 'club')->where('id', '=', $userId)->get();
            //return $users;
        } else if (permission() == 'system-admin') {
            $users = User::with('area', 'role', 'club')->latest()->get();
        }else if(permission() == 'super-admin'){
            $users = User::with('area', 'role', 'club')->where('club_id', '=', $clubId)->get();
        }else if(permission() == 'area-admin'){
            $users = User::with('area', 'role')
                ->where('area_id', '=', Auth::user()->area_id)
                ->where('club_id', '=', Auth::user()->club_id)
                ->latest()->get();
        }
        return view('backend.users.index', compact('users'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('user-create');
        $roles = Role::getRole();
        $clubs = Club::all();
        $areas = Area::active()->get();
        return view('backend.users.form', compact('roles', 'areas', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('user-create');
        //return $request;
        $this->validate($request, [
//            'name' => 'required|string|max:255',
            //'name_bn' => 'required|string|max:255',
//            'username' => 'required|string|max:255|regex:/^\S*$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
            'area' => 'required',
            'club' => 'required',
            'password' => 'required|confirmed|string|min:8'
        ]);

        $user = User::create([
            'role_id' => $request->role,
            'area_id' => $request->area,
            'club_id' => $request->club,
            //'name' => $request->name,
            'name_bn' => $request->name_bn,
//            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->filled('status')
        ]);

        notify()->success("User Added", "Success");

        return redirect()->route('app.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('user-update');
        $roles = Role::getRole();
        $areas = Area::active()->get();
        $clubs = Club::all();
        return view('backend.users.form', compact('roles', 'user', 'areas', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('user-update');
        $this->validate($request, [
            //'name' => 'required|string|max:255',
            //'name_bn' => 'required|string|max:255',
//            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required',
            'area' => 'required',
            'club' => 'required',
            'password' => 'nullable|confirmed|string|min:8'
        ]);

        $user->update([
            'role_id' => $request->role,
            'area_id' => $request->area,
            'club_id' => $request->club,
            //'name' => $request->name,
            'name_bn' => $request->name_bn,
//            'username' => $request->username,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' => $request->filled('status')
        ]);

        if ($request->filled('status')) {

            $details = [
                'title' => 'Welcome!',
                'body' => 'Your account has been approved by the authority. Now you can visit https://slc.itdte.net/ with your valid information'
            ];

            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
        }

        notify()->success("User Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('user-delete');
        $user->delete();
        notify()->success("User Deleted", "Success");
        return back();
    }
}
