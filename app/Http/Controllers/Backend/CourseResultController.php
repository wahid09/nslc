<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CourseResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('course-result-index');
        $courseResults = DB::table('course_results')
        ->join('courses', 'course_results.course_id', '=', 'courses.id')
        ->select('course_results.*', 'courses.course_name')->get();
        //dd($courseResults);
        return view('backend.courseResult.index', [
            'courseResults' => $courseResults
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('course-result-create');
        $courses = Course::active()->get();
        return view('backend.courseResult.form', [
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('course-result-create');
        //dd($request->all());
        $this->validate($request, [
            'course_id' => 'required',
            'course_doc' => 'required|mimes:pdf|max:2048',
            'status' => 'nullable',
            'description' => 'nullable',
            'publish_date' => 'nullable',
        ]);
        if ($request->hasFile('course_doc')) {
            $file = $request->file('course_doc');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $folder = 'result';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            $path = Storage::disk('public')->putFileAs($folder, $file, $fileName);
            //$path = $file->storeAs($folder, $fileName, 'local'); // Stores in storage/app/result
        }else{
            $fileName = null;
        }
        $re = CourseResult::create([
            'course_id' => $request->get('course_id'),
            'result_documents' => $fileName,
            'status' => $request->filled('status'),
            'publish_date' => $request->get('publish_date'),
            'description' => $request->get('description')
        ]);
        notify()->success("Result Added", "Success");

        return redirect()->route('app.courseResult.index');
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
    public function edit(CourseResult $courseResult)
    {
        Gate::authorize('course-result-edit');
        $courses = Course::active()->get();
        return view('backend.courseResult.form', [
            'courses' => $courses,
            'courseResult' => $courseResult
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseResult $courseResult)
    {
        Gate::authorize('course-result-edit');
        $this->validate($request, [
            'course_id' => 'required',
            'course_doc' => 'required|mimes:pdf|max:2048',
            'status' => 'nullable',
            'description' => 'nullable',
            'publish_date' => 'nullable',
        ]);
        if ($request->hasFile('course_doc')) {
            $file = $request->file('course_doc');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $folder = 'result';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            $path = $file->storeAs($folder, $fileName, 'local'); // Stores in storage/app/result
        }else{
            $fileName = null;
        }
        $courseResult->update([
            'course_id' => $request->get('course_id'),
            'result_documents' => $fileName,
            'status' => $request->filled('status'),
            'publish_date' => $request->get('publish_date'),
            'description' => $request->get('description')
        ]);
        notify()->success("Result Updated", "Success");

        return redirect()->route('app.courseResult.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseResult $courseResult)
    {
        Gate::authorize('course-result-delete');
        $fileName = $courseResult->result_documents;
        if (Storage::exists('result/' . $fileName)) {
            Storage::delete('result/' . $fileName);
        }
        $courseResult->delete();
        notify()->success("Course result Deleted", "Success");
        return redirect()->back();
    }
}
