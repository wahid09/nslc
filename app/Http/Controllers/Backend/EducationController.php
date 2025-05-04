<?php

namespace App\Http\Controllers\Backend;

use App\Models\Area;
use App\Models\Club;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('education-index');
        $educations = Education::latest()->get();
        return view('backend.education.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('education-create');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.education.form', compact('pages', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('education-create');
        $this->validate($request, [
            'club' => 'required',
            'description_bn' => 'required'
        ]);
        $education = Education::create([
            'club_id'=>$request->club,
            'area_id'=>$request->area,
            'description_bn'=>$request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Education Activites Updated", "Success");
        return redirect()->route('app.educations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        Gate::authorize('education-update');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.education.form', compact('pages', 'areas', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        Gate::authorize('education-update');
        $this->validate($request, [
            'club' => 'required',
            'description_bn' => 'required'
        ]);
        $education->update([
            'club_id'=>$request->club,
            'area_id'=>$request->area,
            'description_bn'=>$request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Education Activites Updated", "Success");
        return redirect()->route('app.educations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        Gate::authorize('education-delete');
        $education->delete();
        notify()->success("Education Activites Deleted", "Success");
        return redirect()->route('app.educations.index');
    }
}
