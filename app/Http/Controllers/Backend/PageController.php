<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('page-index');
        $pages = Page::all();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('page-create');
        return view('backend.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('page-create');
        $this->validate($request, [
            'title_bn' => 'required|string|unique:pages|max:255',
            'slno' => 'required'
        ]);
        $pages = Page::create([
            'title_bn' => $request->title_bn,
            'slno' => $request->slno,
            'slug' => Str::slug($request->title_bn),
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Page Added", "Success");

        return redirect()->route('app.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        Gate::authorize('page-update');
        return view('backend.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        Gate::authorize('page-update');
        $this->validate($request, [
            'slno' => 'required',
            'title_bn' => 'required|string|max:255'
        ]);

        $page->update([
            'slno' => $request->slno,
            'title_bn' => $request->title_bn,
            'slug' => Str::slug($request->title_bn),
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Page Update", "Success");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Gate::authorize('page-delete');
        $page->delete();
        notify()->success("Page Deleted", "Success");
        return back();
    }
}
