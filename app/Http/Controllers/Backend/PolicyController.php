<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('policy-index');
        $policy = Policy::all();
        return view('backend.policy.index', compact('policy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('policy-create');
        $clubs = Club::all();
        return view('backend.policy.form', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('policy-create');
        //return $request;
        $this->validate($request, [
            'attachment' => 'mimes:pdf,docx',
            'club' => 'required'
        ]);
        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //$this->pr($fileNameWithExt);
            $fileName = pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = pathInfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileSize = $request->file('attachment')->getSize();
            $mimeType = $request->file('attachment')->getMimeType();
            $fileProperty = pathInfo($fileNameWithExt);
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('attachment')->storeAs('public/policy', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }
        $policy = Policy::create([
            'club_id' => $request->club,
            'title' => $request->title,
            'attachment' => $fileNameToStore,
            'status' => $request->filled('status'),
            'corected' => $request->filled('corected')
        ]);
        notify()->success("Policy Added", "Success");
        return redirect()->route('app.policy.index');
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
    public function edit(Policy $policy)
    {
        Gate::authorize('policy-update');
        $clubs = Club::all();
        return view('backend.policy.form', compact('clubs', 'policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        Gate::authorize('policy-update');
        //return $policy;
        $this->validate($request, [
            'attachment' => 'mimes:pdf,docx',
            'club' => 'required'
        ]);
        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //$this->pr($fileNameWithExt);
            $fileName = pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = pathInfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileSize = $request->file('attachment')->getSize();
            $mimeType = $request->file('attachment')->getMimeType();
            $fileProperty = pathInfo($fileNameWithExt);
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('attachment')->storeAs('public/policy', $fileNameToStore);
        }
        if (empty($request->hasFile('attachment'))) {
            $fileNameToStore = $policy->attachment;
        }
        $policy->update([
            'club_id' => $request->club,
            'title' => $request->title,
            'attachment' => $fileNameToStore,
            'status' => $request->filled('status'),
            'corected' => $request->filled('corected')
        ]);
        notify()->success("Policy Updated", "Success");
        return redirect()->route('app.policy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        Gate::authorize('policy-delete');
        $policy->delete();
        notify()->success("Policy Deleted", "Success");
        return back();
    }
}
