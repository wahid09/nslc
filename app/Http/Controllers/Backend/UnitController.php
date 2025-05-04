<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('access-unit');
        $units = Unit::select('id', 'unit_name_en', 'unit_name_bn', 'is_active')->get();
        return view('backend.units.index', [
            'units' => $units
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create-unit');
        return view('backend.units.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create-unit');
        $this->validate($request, [
            'unit_name_en'=>'required',
            'unit_name_bn'=>'nullable'
        ]);
        $ranks = Unit::create([
            'unit_name_en'=> $request->unit_name_en,
            'unit_name_bn'=> $request->unit_name_bn,
            'is_active'=> $request->filled('status')
        ]);
        notify()->success("Unit Added", "Success");
        return redirect()->route('app.unit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('access-unit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('edit-unit');
        $unit = Unit::find($id);
        return view('backend.units.form', [
            'unit' => $unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        Gate::authorize('update-unit');
        $this->validate($request, [
            'unit_name_en'=>'required',
            'unit_name_bn'=>'nullable'
        ]);
        $unit->update([
            'unit_name_en'=> $request->unit_name_en,
            'unit_name_bn'=> $request->unit_name_bn,
            'is_active'=> $request->filled('status')
        ]);
        notify()->success("Unit Updated", "Success");
        return redirect()->route('app.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        Gate::authorize('delete-unit');
        $unit->delete();
        notify()->success("Unit Deleted", "Success");
        return redirect()->back();
    }
}
