<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use App\Models\Prokasone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('publication-index');
        $publications = Prokasone::active()->latest()->get();
        return view('backend.publication.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('publication-create');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('backend.publication.form', compact('areas', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('publication-create');
        $this->validate($request, [
            'club'=>'required',
            'area'=>'required',
            'title_bn'=>'required',
            'description_bn'=>'required',
            'attachment'=>'required|mimes:pdf,docx,zip',
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
            $path = $request->file('attachment')->storeAs('public/publication', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }
        $publication = Prokasone::create([
            'club_id'=> $request->club,
            'area_id'=> $request->area,
            'title_bn'=>$request->title_bn,
            'description_bn'=>$request->description_bn,
            'attachment'=>$fileNameToStore,
            'status' => $request->filled('status')
        ]);
        notify()->success("Publication Added", "Success");
        return redirect()->route('app.publications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prokasone  $prokasone
     * @return \Illuminate\Http\Response
     */
    public function show(Prokasone $prokasone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prokasone  $prokasone
     * @return \Illuminate\Http\Response
     */
    public function edit(Prokasone $publication)
    {
        Gate::authorize('publication-update');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('backend.publication.form', compact('areas', 'clubs', 'publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prokasone  $prokasone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prokasone $publication)
    {
        Gate::authorize('publication-update');
        $this->validate($request, [
            'club'=>'required',
            'area'=>'required',
            'title_bn'=>'required',
            'description_bn'=>'required',
            'attachment'=>'mimes:pdf,docx,zip',
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
            $path = $request->file('attachment')->storeAs('public/publication', $fileNameToStore);
        }
        if (!empty($fileNameToStore)) {
            if (Storage::disk('public')->exists('publication/' . $publication->attachment)) {
                Storage::disk('public')->delete('publication/' . $publication->attachment);
            }
        }

        if (empty($fileNameToStore) && !empty($publication->attachment)) {
            $fileNameToStore = $publication->attachment;
        }
        //return $fileNameToStore;
        $publication->update([
            'club_id'=> $request->club,
            'area_id'=> $request->area,
            'title_bn'=>$request->title_bn,
            'description_bn'=>$request->description_bn,
            'attachment'=>$fileNameToStore,
            'status' => $request->filled('status')
        ]);
        notify()->success("Publication Update", "Success");
        //return redirect()->route('app.publications.index');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prokasone  $prokasone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prokasone $publication)
    {
        Gate::authorize('publication-delete');
        //return $publication;
        if (Storage::disk('public')->exists('publication/' . $publication->attachment)) {
            Storage::disk('public')->delete('publication/' . $publication->attachment);
        }
        $publication->delete();
        notify()->success("Page Content Deleted", "Success");
        return back();
    }
}
