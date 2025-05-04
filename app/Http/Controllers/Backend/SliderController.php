<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('slider-index');
        $sliders = Slider::all();
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('slider-create');
        $pages = Club::getClubs();
        return view('backend.sliders.form', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('slider-create');
        $this->validate($request, [
            'title_bn'=>'required',
            'slide'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required',
            'club'=>'required'
        ]);

        $image = $request->file('slide');
        $name = Str::slug($request->input('title_bn'));
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $slideName  = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('slider/'))
            {
                Storage::disk('public')->makeDirectory('slider/');
            }
            $slideImage = Image::make($image)->resize(1366,682)->stream();
            Storage::disk('public')->put('slider/'.$slideName,$slideImage);
        } else {
            $slideName = "default.png";
        }

        $sliders = Slider::create([
            'club_id'=>$request->club,
            'title_bn' => $request->title_bn,
            'slide'=>$slideName,
            'description'=>$request->description,
            'status' => $request->filled('status')
        ]);
        notify()->success("Slider Added", "Success");

        return redirect()->route('app.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        Gate::authorize('slider-update');
        $pages = Club::getClubs();
        return view('backend.sliders.form', compact('pages', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        Gate::authorize('slider-update');
        //return $request;
        $this->validate($request, [
            'title_bn'=>'required',
            'slide'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required',
            'club'=>'required'
        ]);
        $image = $request->file('slide');
        $name = Str::slug($request->input('title_bn'));
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $slideName  = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('slider/'))
            {
                Storage::disk('public')->makeDirectory('slider/');
            }
            $slideImage = Image::make($image)->resize(1366,682)->stream();
            Storage::disk('public')->put('slider/'.$slideName,$slideImage);
        }
        if(!empty($slideName)){
            if (Storage::disk('public')->exists('slider/'.$slider->slide)){
                Storage::disk('public')->delete('slider/'.$slider->slide);
            }
        }

        if(empty($slideName) && !empty($slider->slide)){
            $slideName = $slider->slide;
        }

        //print_r($slideName);
        //dd($slideName);
        $slider->update([
            'club_id'=>$request->club,
            'title_bn' => $request->title_bn,
            'slide'=>$slideName,
            'description'=>$request->description,
            'status' => $request->filled('status')
        ]);

        notify()->success("Slider Updated", "Success");
        return redirect()->route('app.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Gate::authorize('slider-delete');
        if (Storage::disk('public')->exists('slider/'.$slider->slide)){
            Storage::disk('public')->delete('slider/'.$slider->slide);
        }
        $slider->delete();
        notify()->success("Slider Deleted", "Success");
        return back();

    }
}
