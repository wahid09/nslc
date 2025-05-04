<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('rank-index');
        $ranks = Rank::all();
        return view('backend.rank.index', compact('ranks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('rank-create');
        return view('backend.rank.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('rank-create');
        $this->validate($request, [
            'name'=>'required',
            'name_bn'=>'required',
            'rank_order'=>'required'
        ]);
        $ranks = Rank::create([
            'name'=> $request->name,
            'name_bn'=> $request->name_bn,
            'rank_order'=> $request->rank_order,
            'status'=> $request->filled('status')
        ]);
        notify()->success("Rank Added", "Success");
        return redirect()->route('app.ranks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $rank)
    {
        Gate::authorize('rank-update');
        return view('backend.rank.form', compact('rank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rank $rank)
    {
        Gate::authorize('rank-update');
        $this->validate($request, [
            'name'=>'required',
            'name_bn'=>'required',
            'rank_order'=>'required'
        ]);
        $rank->update([
            'name'=> $request->name,
            'name_bn'=> $request->name_bn,
            'rank_order'=> $request->rank_order,
            'status'=> $request->filled('status')
        ]);
        notify()->success("Rank Update", "Success");
        return redirect()->route('app.ranks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank)
    {
        Gate::authorize('rank-delete');
        $rank->delete();
        notify()->success("Rank Deleted", "Success");
        return redirect()->back();
    }
}
