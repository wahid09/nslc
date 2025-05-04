<?php

namespace App\Http\Controllers\Backend;

use App\Models\Area;
use App\Models\ShowRoome;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ShowRoomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('showroome-index');
        $showroomes = ShowRoome::getShowroom();
        //return $showroomes;
        return view('backend.showroomes.index', compact('showroomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('showroome-create');
        $areas = Area::getArea();
        return view('backend.showroomes.form', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('showroome-create');
        $this->validate($request, [
            'title' => 'required',
            'house' => 'required',
            'road' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showrooms/')) {
                Storage::disk('public')->makeDirectory('showrooms/');
            }
            $makImage = Image::make($image)->resize(384, 270)->stream();
            Storage::disk('public')->put('showrooms/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }

        ShowRoome::create([
            'area_id' => $request->area_id,
            'title' => $request->title,
            'house' => $request->house,
            'road' => $request->road,
            'area' => $request->area,
            'phone' => $request->phone,
            'image'=>$imageName,
            'status' => $request->filled('status')
        ]);

        notify()->success("Show Roome Added", "Success");
        return redirect()->route('app.showroome.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('showroome-update');
        $showroomes = ShowRoome::findOrFail($id);
        $areas = Area::getArea();
        return view('backend.showroomes.form', compact('showroomes', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $showroomes = ShowRoome::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'house' => 'required',
            'road' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showrooms/')) {
                Storage::disk('public')->makeDirectory('showrooms/');
            }
            $makImage = Image::make($image)->resize(384, 270)->stream();
            Storage::disk('public')->put('showrooms/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('showrooms/' . $showroomes->image)) {
                Storage::disk('public')->delete('showrooms/' . $showroomes->image);
            }
        }

        if (empty($imageName) && !empty($showroomes->image)) {
            $imageName = $showroomes->image;
        }

        $showroomes->update([
            'area_id' => $request->area_id,
            'title' => $request->title,
            'house' => $request->house,
            'road' => $request->road,
            'area' => $request->area,
            'phone' => $request->phone,
            'image'=>$imageName,
            'status' => $request->filled('status')
        ]);

        notify()->success("Show Roome update", "Success");
        //return redirect()->route('app.showroome.index');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('showroome-delete');
        $showroomes = ShowRoome::findOrFail($id);
        $showroomes->delete();
        notify()->success("Show Roome deleted", "Success");
        return back();
    }
}
