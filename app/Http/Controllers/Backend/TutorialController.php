<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Tutorial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tutorial-index');
        if (permission() == 'system-admin') {
            $tutorials = Tutorial::latest()->get();
        } elseif (permission() == 'super-admin') {
            $tutorials = Tutorial::latest()->active()->where('role_id', 2)->get();
        } else {
            $tutorials = Tutorial::latest()->active()->where('role_id', 5)->get();
        }

        return view('backend.tutorial.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('tutorial-create');
        $roles = Role::get();
        return view('backend.tutorial.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('tutorial-create');
        $this->validate($request, [
            'video' => 'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:200040',
            'role' => 'required',
            'title' => 'required|string'
        ]);
        $video = $request->file('video');
        $input = time() . $video->getClientOriginalExtension();
        $destinationPath = 'uploads/videos';
        $video->move($destinationPath, $input);

        $tutorials = Tutorial::create([
            'title' => $request->title,
            'role_id' => $request->role,
            'video' => $input,
            'status' => $request->filled('status')
        ]);
        if ($tutorials) {
            notify()->success("Tutorial Added", "Success");
            return redirect()->route('app.tutorial.index');
        } else {
            notify()->success("Something went wrong", "Error");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tutorial $tutorial
     * @return \Illuminate\Http\Response
     */
    public function show(Tutorial $tutorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tutorial $tutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutorial $tutorial)
    {
        $roles = Role::get();
        return view('backend.tutorial.form', compact('roles', 'tutorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tutorial $tutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        $this->validate($request, [
            'video' => 'nullable|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:200040',
            'role' => 'required',
            'title' => 'required|string'
        ]);
        $video = $request->file('video');
        if ($video) {
            $input = time() . $video->getClientOriginalExtension();
            $destinationPath = 'uploads/videos';
            $video->move($destinationPath, $input);
        }else{
           $input = $tutorial->video;
        }

        $tutorials = $tutorial->update([
            'title' => $request->title,
            'role_id' => $request->role,
            'video' => $input,
            'status' => $request->filled('status')
        ]);
        if ($tutorials) {
            notify()->success("Tutorial Updated", "Success");
            return redirect()->route('app.tutorial.index');
        } else {
            notify()->success("Something went wrong", "Error");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tutorial $tutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        Gate::authorize('tutorial-delete');
        if ($tutorial->video) {
            $path = public_path() . "/uploads/videos/" . $tutorial->video;
            unlink($path);
        }
        $tutorials = $tutorial->delete();
        if ($tutorials) {
            notify()->success("Tutorial Deleted", "Success");
            return redirect()->back();
        } else {
            notify()->success("Somethings went wrong", "Error");
            return redirect()->back();
        }
    }
}
