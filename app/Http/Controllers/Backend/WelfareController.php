<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Club;
use App\Models\Welfare;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class WelfareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('welfare-index');
        $welfares = Welfare::getWelfare();
        return view('backend.welfare.index', compact('welfares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('welfare-create');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.welfare.form', compact('pages', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('welfare-create');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'area' => 'required',
            'club' => 'required'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('welfare/')) {
                Storage::disk('public')->makeDirectory('welfare/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('welfare/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }
        $welfare = Welfare::create([
            'title_bn' => $request->title_bn,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'page_id' => $request->club,
            'image' => $imageName,
            'slogan_bn' => $request->slogan_bn,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Welfare Activities Added", "Success");
        return redirect()->route('app.welfares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Welfare  $welfare
     * @return \Illuminate\Http\Response
     */
    public function show(Welfare $welfare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Welfare  $welfare
     * @return \Illuminate\Http\Response
     */
    public function edit(Welfare $welfare)
    {
        Gate::authorize('welfare-update');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        return view('backend.welfare.form', compact('pages', 'areas', 'welfare'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Welfare  $welfare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Welfare $welfare)
    {
        Gate::authorize('welfare-update');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'area' => 'required',
            'club' => 'required'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('welfare/')) {
                Storage::disk('public')->makeDirectory('programs/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('welfare/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('welfare/' . $welfare->image)) {
                Storage::disk('public')->delete('welfare/' . $welfare->image);
            }
        }

        if (empty($imageName) && !empty($welfare->image)) {
            $imageName = $welfare->image;
        }
        $welfare->update([
            'title_bn' => $request->title_bn,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'page_id' => $request->club,
            'image' => $imageName,
            'slogan_bn' => $request->slogan_bn,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        //$program->areas()->sync($request->input('area'));

        notify()->success("Welfare Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Welfare  $welfare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Welfare $welfare)
    {
        Gate::authorize('welfare-delete');
        if (Storage::disk('public')->exists('welfare/' . $welfare->image)) {
            Storage::disk('public')->delete('welfare/' . $welfare->image);
        }
        $welfare->delete();
        notify()->success("Welfare Deleted", "Success");
        return back();
    }
}
