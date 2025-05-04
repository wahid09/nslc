<?php

namespace App\Http\Controllers\LadiesClub;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BloodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloodGroups = BloodGroup::select('id', 'group_name', 'is_active')->get();
        return view('ladiesClub.bloodGroup.index', [
            'bloodGroups' => $bloodGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ladiesClub.bloodGroup.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create-blood');
        $this->validate($request, [
            'group_name'=>'required'
        ]);
        $bloodGroup = BloodGroup::create([
            'group_name' => $request->group_name,
            'is_active' => $request->filled('status')
        ]);
        notify()->success("Group added Added", "Success");
        return redirect()->route('app.blood-group.index');
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
    public function edit(BloodGroup $BloodGroup)
    {
        Gate::authorize('update-blood');
        return view('ladiesClub.bloodGroup.form', [
            'blood' => $BloodGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodGroup $BloodGroup)
    {
        Gate::authorize('update-blood');
        $this->validate($request, [
            'group_name'=>'required'
        ]);
        $BloodGroup->update([
            'group_name' => $request->group_name,
            'is_active' => $request->filled('status')
        ]);
        notify()->success("Group added Added", "Success");
        return redirect()->route('app.blood-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodGroup $BloodGroup)
    {
        Gate::authorize('delete-blood');
        $BloodGroup->delete();
        notify()->success("Blood Deleted", "Success");
        return back();
    }
}
