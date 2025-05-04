<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ChipCalender;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChipCalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('chif-calender-index');
        $calenders = ChipCalender::all();
        return view('backend.chifCalender.index', compact('calenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('chif-calender-create');
        $calenders = ChipCalender::active()->get();
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.chifCalender.form', compact('calenders', 'pages', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('chif-calender-create');
        //return $request;
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'club'=>'required',
            'area'=>'required',
            'end'=>'required'
        ]);

        $calender = ChipCalender::create([
            'club_id' => $request->club,
            'area_id'=>$request->area,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'status' => $request->filled('status')
        ]);

        notify()->success('Chif Caleneder Added', 'success');
        return redirect()->route('app.chipCalenders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChipCalender  $chipCalender
     * @return \Illuminate\Http\Response
     */
    public function show(ChipCalender $chipCalender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChipCalender  $chipCalender
     * @return \Illuminate\Http\Response
     */
    public function edit(ChipCalender $chipCalender)
    {
        Gate::authorize('chif-calender-update');
        $calenders = ChipCalender::active()->get();
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.chifCalender.form', compact('calenders', 'pages', 'areas', 'chipCalender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChipCalender  $chipCalender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChipCalender $chipCalender)
    {
        Gate::authorize('chif-calender-update');
        //return $request;
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'club'=>'required',
            'area'=>'required',
            'end'=>'required'
        ]);

        $chipCalender->update([
            'club_id' => $request->club,
            'area_id'=>$request->area,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'status' => $request->filled('status')
        ]);

        notify()->success('Chif Caleneder Updated', 'success');
        return redirect()->route('app.chipCalenders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChipCalender  $chipCalender
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChipCalender $chipCalender)
    {
        Gate::authorize('chif-calender-delete');
        $chipCalender->delete();
        notify()->success('Deleted Success', 'success');
        return back();
    }
}
