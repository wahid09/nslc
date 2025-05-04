<?php

namespace App\Http\Controllers\LadiesClub;

use App\BanglaDate;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use App\Models\Event;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class LadiesClubEventController extends Controller
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
        Gate::authorize('lce-index');
        $events = Event::select('id', 'title_bn', 'description_bn', 'event_date', 'start_time', 'end_time', 'status', 'is_attend')
            ->where('club_id', 2)->get();
        return view('ladiesClub.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('lce-create');
        Gate::authorize('event-create');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        return view('ladiesClub.event.form', compact('areas', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('lce-create');
        Gate::authorize('event-create');
        $validated = $request->validate([
            'title_bn' => 'required',
            'description_bn' => 'required',
            'area' => 'required',
            'event_date' => 'required|date'
        ]);

        // Format date and convert to Bangla date
        $formattedDate = date('d M Y', strtotime($validated['event_date']));
        $banglaDate = $this->banglaDate->bn_date_time($formattedDate);
        // Create notice
        $time = $request->event_date;
        $time = date('h:i A', strtotime($request->start_date));
        $start_time = $this->banglaDate->bn_time($time);
        Event::create([
            'title_bn' => $validated['title_bn'],
            'description_bn' => $validated['description_bn'],
            'area_id' => $validated['area'],
            'club_id' => 2,
            'event_date' => $banglaDate,
            'start_time' => $start_time,
            'end_time' => $start_time,
            'status' => $request->filled('status')
        ]);

        notify()->success("Event Added", "Success");
        return redirect()->route('app.ladies-club-event.index');
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
    public function edit($id)
    {
        Gate::authorize('lce-edit');
        $areas = Area::getArea();
        $clubs = Club::getClubs();
        $event = Event::findOrfail($id);
        return view('ladiesClub.event.form', compact('event', 'areas', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('lce-edit');
        $validated = $request->validate([
            'title_bn' => 'required',
            'description_bn' => 'required',
            'area' => 'required',
            'event_date' => 'required|date'
        ]);

        // Format date and convert to Bangla date
        $formattedDate = date('d M Y', strtotime($validated['event_date']));
        $banglaDate = $this->banglaDate->bn_date_time($formattedDate);
        // Create notice
        $time = $request->event_date;
        $time = date('h:i A', strtotime($request->start_date));
        $start_time = $this->banglaDate->bn_time($time);
        $event = Event::findOrFail($id);
        $event->update([
            'title_bn' => $validated['title_bn'],
            'description_bn' => $validated['description_bn'],
            'area_id' => $validated['area'],
            'club_id' => 2,
            'event_date' => $banglaDate,
            'start_time' => $start_time,
            'end_time' => $start_time,
            'status' => $request->filled('status')
        ]);

        notify()->success("Event Updated", "Success");
        return redirect()->route('app.ladies-club-event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('lce-delete');
        $event = Event::findOrFail($id);
        $event->delete();
        notify()->success("event Deleted", "Success");
        return back();
    }
}
