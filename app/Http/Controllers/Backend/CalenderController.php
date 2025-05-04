<?php

namespace App\Http\Controllers\Backend;

use App\Models\Area;
use DB;
use App\Models\Club;
use App\Models\Calender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('calender-index');
        //$calenders = Calender::all();
        $calenders = Calender::getCalender();
        return view('backend.calender.index', compact('calenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('calender-create');
        $calenders = Calender::active()->get();
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.calender.form', compact('calenders', 'pages', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('calender-create');
        //return $request;
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'club'=>'required',
            'area'=>'required'
        ]);
        if (!empty($request->groupId) && !empty($request->repeating)) {
            $groupId = $request->groupId;
            $extra = 99;
            $id = $extra . $groupId;
        } else {
            $id = null;
        }
        $calender = Calender::create([
            'club_id' => $request->club,
            'area_id'=>$request->area,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'groupId' => $id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->filled('status'),
            'repeating' => $request->filled('repeating')
        ]);
        if (!empty($request->groupId) && !empty($request->repeating)) {
            $fields = [
                'groupId' => $id
            ];
            $success = DB::table('calenders')
                ->where('id', $groupId)
                ->update($fields);
        }
        notify()->success('Caleneder Added', 'success');
        return redirect()->route('app.calender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calender  $calender
     * @return \Illuminate\Http\Response
     */
    public function show(Calender $calender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calender  $calender
     * @return \Illuminate\Http\Response
     */
    public function edit(Calender $calender)
    {
        Gate::authorize('calender-update');
        $calenders = Calender::active()->get();
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.calender.form', compact('calenders', 'calender', 'pages', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calender  $calender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calender $calender)
    {
        Gate::authorize('calender-update');
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'club'=>'required',
            'area'=>'required'
        ]);
        if (!empty($request->groupId) && !empty($request->repeating)) {
            $groupId = $request->groupId;
            $extra = 99;
            $id = $extra . $groupId;
        } else {
            $id = null;
        }
        $calender->update([
            'club_id' => $request->club,
            'area_id' => $request->area,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'groupId' => $id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->filled('status'),
            'repeating' => $request->filled('repeating')
        ]);
        if (!empty($request->groupId) && !empty($request->repeating)) {
            $fields = [
                'groupId' => $id
            ];
            $success = DB::table('calenders')
                ->where('id', $groupId)
                ->update($fields);
        }
        notify()->success('Caleneder update', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calender  $calender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calender $calender)
    {
        Gate::authorize('calender-delete');
        $calender->delete();
        notify()->success('Deleted Success', 'success');
        return back();
    }
}
