<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use App\Models\Page;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('program-index');
        $programs = Program::getProgram();
        return view('backend.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('program-create');
        $areas = Area::getArea();
        $pages = Club::getClubs();
        return view('backend.programs.form', compact('areas', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        Gate::authorize('program-create');
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
            if (!Storage::disk('public')->exists('programs/')) {
                Storage::disk('public')->makeDirectory('programs/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('programs/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }
        $programs = Program::create([
            'title_bn' => $request->title_bn,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'page_id' => $request->club,
            'image' => $imageName,
            'slogan_bn' => $request->slogan_bn,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);

        notify()->success("Program Added", "Success");
        return redirect()->route('app.programs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        Gate::authorize('program-update');
        $areas = Area::getArea();
        $pages = Club::getClubs();
        return view('backend.programs.form', compact('areas', 'program', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        Gate::authorize('program-update');
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
            if (!Storage::disk('public')->exists('programs/')) {
                Storage::disk('public')->makeDirectory('programs/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('programs/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('programs/' . $program->image)) {
                Storage::disk('public')->delete('programs/' . $program->image);
            }
        }

        if (empty($imageName) && !empty($program->image)) {
            $imageName = $program->image;
        }
        $program->update([
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

        notify()->success("Program Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        Gate::authorize('program-delete');
        if (Storage::disk('public')->exists('programs/' . $program->image)) {
            Storage::disk('public')->delete('programs/' . $program->image);
        }
        $program->delete();
        notify()->success("Program Deleted", "Success");
        return back();
    }
}
