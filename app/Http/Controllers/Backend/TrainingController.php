<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Carbon\Carbon;
use App\BanglaDate;
use App\Models\Area;
use App\Models\Club;
use App\Models\Page;
use App\Models\User;
use App\Models\Training;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TrainingCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    public $banglaDate;

    public function __construct()
    {
        $this->banglaDate = new BanglaDate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('training-index');
        $clubId = Auth::user()->club_id;
        $areaId = Auth::user()->area_id;
        $trainnings = Training::getTraining();
        return view('backend.training.index', compact('trainnings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('training-create');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        $trainCategories = TrainingCategory::active()->get();
        return view('backend.training.form', compact('pages', 'areas', 'trainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('training-create');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'area' => 'required',
            'category' => 'required',
        ]);

        $date = date('d M', strtotime($request->training_date));
        $date = $this->banglaDate->bn_date($date);
        //return $date;
        /*
        $time = $request->start_time;
        $time = date('h:i A', strtotime($request->start_time));
        $start_time = $this->banglaDate->bn_time($time);

        $time = $request->end_time;
        $time = date('h:i A', strtotime($time));
        $end_time = $this->banglaDate->bn_time($time);
        */
        //return $time;

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('training/')) {
                Storage::disk('public')->makeDirectory('training/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('training/' . $imageName, $makImage);
        } else {
            $imageName = "";
        }

        $training = Training::create([
            'page_id' => 1,
            'club_id' => $request->club,
            'area_id' => $request->area,
            'training_categorie_id' => $request->category,
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'training_date' => $date,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Training Added", "Success");
        return redirect()->route('app.training.index');
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
    public function edit(Training $training)
    {
        Gate::authorize('training-update');
        $pages = Club::getClubs();
        $areas = Area::getArea();
        $trainCategories = TrainingCategory::active()->get();
        return view('backend.training.form', compact('pages', 'training', 'areas', 'trainCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        Gate::authorize('training-update');
        //return $training;
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'area' => 'required',
            'category' => 'required'
        ]);

        $date = date('d M', strtotime($request->training_date));
        $date = $this->banglaDate->bn_date($date);
        if (empty($request->training_date)) {
            $date = $training->training_date;
        }
        //return $date;
        /*
        $time = $request->start_time;
        if (!empty($time)) {
            $time = date('h:i A', strtotime($request->start_time));
            $start_time = $this->banglaDate->bn_time($time);
        } else {
            $start_time = $training->start_time;
        }

        $time = $request->end_time;
        if (!empty($time)) {
            $time = date('h:i A', strtotime($time));
            $end_time = $this->banglaDate->bn_time($time);
        } else {
            $end_time = $training->end_time;
        }
        */
        //return $time;

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('training/')) {
                Storage::disk('public')->makeDirectory('training/');
            }
            $makImage = Image::make($image)->resize(1200, 1000)->stream();
            Storage::disk('public')->put('training/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('training/' . $training->image)) {
                Storage::disk('public')->delete('training/' . $training->image);
            }
        }

        if (empty($imageName) && !empty($training->image)) {
            $imageName = $training->image;
        }

        $training->update([
            'page_id' => 1,
            'club_id' => $request->club,
            'area_id' => $request->area,
            'training_categorie_id' => $request->category,
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'training_date' => $date,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Training Updated", "Success");
        //return redirect()->route('app.training.index');\
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        Gate::authorize('training-delete');
        if (Storage::disk('public')->exists('training/' . $training->image)) {
            Storage::disk('public')->delete('training/' . $training->image);
        }
        $training->delete();
        notify()->success("Training Deleted", "Success");
        return back();
    }
}
