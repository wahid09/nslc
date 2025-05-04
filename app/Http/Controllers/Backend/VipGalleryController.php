<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VipGallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VipGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = VipGallery::all();
        //return  $galleries;
        return view('backend.vipGallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vipGallery.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('vipgallery/')) {
                Storage::disk('public')->makeDirectory('vipgallery/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('vipgallery/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }

        $galleries = VipGallery::create([
            'title' => $request->title,
            'description'=>$request->description,
            'image' => $imageName,
            'status' => $request->filled('status')
        ]);

        notify()->success("Important Gallery Added", "Success");
        return redirect()->route('app.vipGallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VipGallery  $vipGallery
     * @return \Illuminate\Http\Response
     */
    public function show(VipGallery $vipGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VipGallery  $vipGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(VipGallery $vipGallery)
    {
        return view('backend.vipGallery.form', compact('vipGallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VipGallery  $vipGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VipGallery $vipGallery)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('vipgallery/')) {
                Storage::disk('public')->makeDirectory('vipgallery/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('vipgallery/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('vipgallery/' . $vipGallery->image)) {
                Storage::disk('public')->delete('vipgallery/' . $vipGallery->image);
            }
        }

        if (empty($imageName) && !empty($vipGallery->image)) {
            $imageName = $vipGallery->image;
        }
        $vipGallery->update([
            'title' => $request->title,
            'description'=>$request->description,
            'image' => $imageName,
            'status' => $request->filled('status')
        ]);

        notify()->success("Important Gallery Updated", "Success");
        return redirect()->route('app.vipGallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VipGallery  $vipGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(VipGallery $vipGallery)
    {
        if (Storage::disk('public')->exists('vipgallery/' . $vipGallery->image)) {
            Storage::disk('public')->delete('vipgallery/' . $vipGallery->image);
        }
        $vipGallery->delete();
        notify()->success("Important Gallery Deleted", "Success");
        return back();
    }
}
