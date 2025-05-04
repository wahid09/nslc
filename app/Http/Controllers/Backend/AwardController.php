<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Award;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('award-index');
        $awards = Award::all();
        return view('backend.award.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('award-create');
        return view('backend.award.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('award-create');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('award/')) {
                Storage::disk('public')->makeDirectory('award/');
            }
            $makImage = Image::make($image)->resize(867, 567)->stream();
            Storage::disk('public')->put('award/' . $imageName, $makImage);
        } else {
            $imageName = "";
        }

        $awards = Award::create([
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Award Added", "Success");
        return redirect()->route('app.award.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        Gate::authorize('award-update');
        return view('backend.award.form', compact('award'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        Gate::authorize('award-update');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('award/')) {
                Storage::disk('public')->makeDirectory('award/');
            }
            $makImage = Image::make($image)->resize(867, 567)->stream();
            Storage::disk('public')->put('award/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('award/' . $award->image)) {
                Storage::disk('public')->delete('award/' . $award->image);
            }
        }

        if (empty($imageName) && !empty($award->image)) {
            $imageName = $award->image;
        }

        $award->update([
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Award Added", "Success");
        return redirect()->route('app.award.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        Gate::authorize('award-delete');
        if (Storage::disk('public')->exists('award/' . $award->image)) {
            Storage::disk('public')->delete('awaed/' . $award->image);
        }
        $award->delete();
        notify()->success("Award Deleted", "Success");
        return back();
    }
}
