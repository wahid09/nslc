<?php

namespace App\Http\Controllers\LadiesClub;

use App\BanglaDate;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Models\Notice;

class LadiesClubNoticeController extends Controller
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
        Gate::authorize('lcn-index');
        $user = Auth::user();
        $notices = \DB::table('notices');

        if (permission() !== 'system-admin') {
            $notices->where('club_id', $user->club_id)
                ->where('area_id', $user->area_id);
        }

        $notices = $notices->latest('created_at')->get();
        //return $notices;
        return view('ladiesClub.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('lcn-create');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('ladiesClub.notice.form', compact('areas', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('lcn-create');
        $validated = $request->validate([
            'title_bn' => 'required',
            'description_bn' => 'required',
            'attachment' => 'nullable|mimes:pdf,docx,zip',
            'area' => 'required',
            'notice_date' => 'required|date'
        ]);

        // Format date and convert to Bangla date
        $formattedDate = date('d M Y', strtotime($validated['notice_date']));
        $banglaDate = $this->banglaDate->bn_date_time($formattedDate);
        // Handle file upload
        $fileNameToStore = '';
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $file->storeAs('public/notices', $fileNameToStore);
        }

        // Create notice
        Notice::create([
            'title_bn' => $validated['title_bn'],
            'description_bn' => $validated['description_bn'],
            'area_id' => $validated['area'],
            'club_id' => 2,
            'notice_date' => $banglaDate,
            'attachment' => $fileNameToStore,
            'status' => $request->filled('status')
        ]);

        notify()->success("Notice Added", "Success");
        return redirect()->route('app.ladies-club-notice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('lcn-index');
        $notice = Notice::findOrfail($id);
        //dd($notice);
        return view('ladiesClub.notice.view', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('lcn-edit');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        $notice = Notice::findOrfail($id);
        return view('ladiesClub.notice.form', compact('notice', 'areas', 'clubs'));
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
        Gate::authorize('lcn-edit');
        $validated = $request->validate([
            'title_bn' => 'required',
            'description_bn' => 'required',
            'attachment' => 'nullable|mimes:pdf,docx,zip',
            'area' => 'required',
            'notice_date' => 'nullable|date',
        ]);
        $notice = Notice::findOrFail($id);
        // Handle Bangla date formatting
        $noticeDate = $validated['notice_date']
            ? $this->banglaDate->bn_date_time(date('d M Y', strtotime($validated['notice_date'])))
            : $notice->notice_date;

        // Handle file upload
        $fileNameToStore = $notice->attachment; // fallback to old attachment
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $file->storeAs('public/notices', $fileNameToStore);
        }

        // Update notice
        $notice->update([
            'title_bn' => $validated['title_bn'],
            'description_bn' => $validated['description_bn'],
            'area_id' => $validated['area'],
            'club_id' => 2,
            'attachment' => $fileNameToStore,
            'notice_date' => $noticeDate,
            'status' => $request->filled('status'),
        ]);

        notify()->success("Notice Updated", "Success");
        return redirect()->route('app.ladies-club-notice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('lcn-delete');
        $notice = Notice::findOrFail($id);
        $notice->delete();
        notify()->success("Notice Deleted", "Success");
        return back();
    }
}
