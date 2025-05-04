<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\BanglaDate;
use DB;
use Auth;

class NoticeController extends Controller
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
        Gate::authorize('notice-index');
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $notices = DB::table('notices')->get();
        }else{
            $notices = DB::table('notices')
                     ->where('club_id', Auth::user()->club_id)
                     ->where('area_id', Auth::user()->area_id)->get();
        }
        //return $notices;
        return view('backend.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('notice-create');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('backend.notices.form', compact('areas', 'clubs'));
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
        Gate::authorize('notice-create');
        $this->validate($request, [
            'title_bn' => 'required',
            'description_bn' => 'required',
            'attachment' => 'mimes:pdf,docx,zip',
            'area'=>'required',
            'club'=>'required'
        ]);
//        if(!empty($request->club)){
//            $club = implode(',', $request->club);
//        }else{
//            $club = '';
//        }
//        if(!empty($request->area)){
//            $area = implode(',', $request->area);
//        }else{
//            $area='';
//        }

        $date = date('d M Y', strtotime($request->notice_date));
        $date = $this->banglaDate->bn_date_time($date);


        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //$this->pr($fileNameWithExt);
            $fileName = pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = pathInfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileSize = $request->file('attachment')->getSize();
            $mimeType = $request->file('attachment')->getMimeType();
            $fileProperty = pathInfo($fileNameWithExt);
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('attachment')->storeAs('public/notices', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }
        $notices = Notice::create([
            'title_bn' => $request->title_bn,
            'area_id' => $request->area,
            'club_id' => $request->club,
            'attachment' => $fileNameToStore,
            'description_bn' => $request->description_bn,
            'notice_date' => $date,
            'status' => $request->filled('status'),
            'private' => $request->filled('private'),
            'is_footer' => $request->filled('is_footer')
        ]);
        notify()->success("Notice Added", "Success");
        return redirect()->route('app.notices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        Gate::authorize('notice-index');
        return view('backend.notices.view', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //return $notice;
        Gate::authorize('notice-update');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('backend.notices.form', compact('notice', 'areas', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //return $request;
        Gate::authorize('notice-update');
//        $this->validate($request, [
//            'title_bn' => 'required',
//            'description_bn' => 'required',
//            'attachment' => 'mimes:pdf,docx,zip',
//        ]);
        $this->validate($request, [
            'title_bn' => 'required',
            'description_bn' => 'required',
            'attachment' => 'mimes:pdf,docx,zip',
            'area'=>'required',
            'club'=>'required'
        ]);

        $date = date('d M Y', strtotime($request->notice_date));
        $date = $this->banglaDate->bn_date_time($date);
        if (empty($request->notice_date)) {
            $date = $notice->notice_date;
        }
//        if($request->filled('private')){
//            $club = implode(',', $request->club);
//            $area = implode(',', $request->area);
//        }else{
//            $club = null;
//            $area = null;
//        }
        //return $date;


        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //$this->pr($fileNameWithExt);
            $fileName = pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = pathInfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileSize = $request->file('attachment')->getSize();
            $mimeType = $request->file('attachment')->getMimeType();
            $fileProperty = pathInfo($fileNameWithExt);
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('attachment')->storeAs('public/notices', $fileNameToStore);
        }
        if (empty($fileNameToStore)) {
            $fileNameToStore = $notice->attachment;
        }
        $notice->update([
            'title_bn' => $request->title_bn,
            'area_id' => $request->area,
            'club_id'=> $request->club,
            'attachment' => $fileNameToStore,
            'description_bn' => $request->description_bn,
            'notice_date' => $date,
            'status' => $request->filled('status'),
            'private' => $request->filled('private'),
            'is_footer' => $request->filled('is_footer')
        ]);
        notify()->success("Notice Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        Gate::authorize('notice-delete');
        $notice->delete();
        notify()->success("Notice Deleted", "Success");
        return back();
    }
}
