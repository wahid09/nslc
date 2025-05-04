<?php

namespace App\Http\Controllers\Backend;

use App\Models\Club;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\Page;
use App\Models\gallery;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('gallery-index');
        $galleries = gallery::getGallery();
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('gallery-create');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.gallery.form', compact('pages', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('gallery-create');
        //return $request;
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('gallery/')) {
                Storage::disk('public')->makeDirectory('gallery/');
            }
            $makImage = Image::make($image)->stream();
            Storage::disk('public')->put('gallery/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }
        $galleries = gallery::create([
            'title_bn' => $request->title_bn,
            'page_id' => 1,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'image' => $imageName,
            'status' => $request->filled('status')
        ]);

        notify()->success("Gallery Added", "Success");
        return redirect()->route('app.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(gallery $gallery)
    {
        Gate::authorize('gallery-update');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.gallery.form', compact('pages', 'gallery', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gallery $gallery)
    {
        Gate::authorize('gallery-update');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('gallery/')) {
                Storage::disk('public')->makeDirectory('gallery/');
            }
            $makImage = Image::make($image)->stream();
            Storage::disk('public')->put('gallery/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('gallery/' . $gallery->image)) {
                Storage::disk('public')->delete('gallery/' . $gallery->image);
            }
        }

        if (empty($imageName) && !empty($gallery->image)) {
            $imageName = $gallery->image;
        }
        $gallery->update([
            'title_bn' => $request->title_bn,
            'page_id' => 1,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'image' => $imageName,
            'status' => $request->filled('status')
        ]);


        notify()->success("Program Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery)
    {
        Gate::authorize('gallery-update');
        if (Storage::disk('public')->exists('gallery/' . $gallery->image)) {
            Storage::disk('public')->delete('gallery/' . $gallery->image);
        }
        $gallery->delete();
        notify()->success("Gallery Deleted", "Success");
        return back();
    }
}
