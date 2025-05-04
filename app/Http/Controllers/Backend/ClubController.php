<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('club-index');
        $clubs = Club::all();
        return view('backend.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('club-create');
        return view('backend.clubs.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('club-create');
        $this->validate($request, [
            'name_bn'=>'required',
            'slogan_bn'=>'required',
            'description_bn'=>'required'
        ]);
        $club = Club::create([
            'name_bn'=>$request->name_bn,
            'slogan_bn'=>$request->slogan_bn,
            'description_bn'=>$request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Club Added", "Success");
        return redirect()->route('app.clubs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        Gate::authorize('club-update');
        return view('backend.clubs.form', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        Gate::authorize('club-update');
        //return $club;
        $this->validate($request, [
            'name_bn'=>'required',
            'slogan_bn'=>'required',
            'description_bn'=>'required'
        ]);
        $club->update([
            'name_bn'=>$request->name_bn,
            'slogan_bn'=>$request->slogan_bn,
            'description_bn'=>$request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Club Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        Gate::authorize('club-delete');
        $club->delete();
        notify()->success("Club Deleted", "Success");
        return back();
    }
}
