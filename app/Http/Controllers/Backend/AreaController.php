<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('area-index');
        $areas = Area::all();
        return view('backend.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('area-create');
        return view('backend.areas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('area-create');
        $this->validate($request, [
            'name' => 'required|string|unique:areas|max:255',
            'name_bn' => 'required|string|unique:areas|max:255'
        ]);

        $area = Area::create([
            'name' => $request->name,
            'name_bn' => $request->name_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Area Added", "Success");

        return redirect()->route('app.area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //return $area;
        Gate::authorize('area-update');
        return view('backend.areas.form', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
        ]);
        $area->update([
            'name' => $request->name,
            'name_bn' => $request->name_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Area Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        Gate::authorize('area-delete');
        $area->delete();
        notify()->success("Area Deleted", "Success");
        return back();
    }
}
