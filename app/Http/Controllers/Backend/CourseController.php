<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('course-index');
        $courses = Course::select('id', 'course_name', 'description', 'start_date', 'end_time', 'status')->get();
        //dd($courses);
        return view('backend.course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('course-create');
        return view('backend.course.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('course-create');
        //dd($request->all());
        $this->validate($request, [
            'course_name' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'nullable',
            'course_start_date' => 'nullable',
            'course_end_date' => 'nullable'
        ]);

        $course = Course::create([
            'course_name' => $request->get('course_name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('course_start_date'),
            'end_time' => $request->get('course_end_date'),
            'status' => $request->filled('status')
        ]);

        notify()->success("Course Added", "Success");

        return redirect()->route('app.course.index');
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
        Gate::authorize('course-edit');
        $course = Course::findOrFail($id);
        return view('backend.course.form', [
            'course' => $course
        ]);
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
        Gate::authorize('course-edit');
        $this->validate($request, [
            'course_name' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'nullable',
            'course_start_date' => 'nullable',
            'course_end_date' => 'nullable'
        ]);
        $course = Course::findOrFail($id);
        $course->update([
            'course_name' => $request->get('course_name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('course_start_date'),
            'end_time' => $request->get('course_end_date'),
            'status' => $request->filled('status')
        ]);

        notify()->success("Course updated", "Success");

        return redirect()->route('app.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Gate::authorize('course-delete');
        $course->delete();
        notify()->success("Course Deleted", "Success");
        return redirect()->back();
    }
}
