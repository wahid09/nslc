<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\BanglaDate;

class EventController extends Controller
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
        Gate::authorize('event-index');
        $events = Event::all();
        return view('backend.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('event-create');
        return view('backend.events.from');
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
        Gate::authorize('event-create');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $date = date('d M', strtotime($request->event_date));
        $date = $this->banglaDate->bn_date($date);
        //return $date;

        $time = $request->start_date;
        $time = date('h:i A', strtotime($request->start_date));
        $start_time = $this->banglaDate->bn_time($time);

        $time = $request->end_date;
        $time = date('h:i A', strtotime($time));
        $end_time = $this->banglaDate->bn_time($time);
        //return $time;

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('events/')) {
                Storage::disk('public')->makeDirectory('events/');
            }
            $makImage = Image::make($image)->resize(368, 304)->stream();
            Storage::disk('public')->put('events/' . $imageName, $makImage);
        } else {
            $imageName = "default.png";
        }

        $events = Event::create([
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'event_date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Event Added", "Success");
        return redirect()->route('app.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        Gate::authorize('event-update');
        return view('backend.events.from', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        Gate::authorize('event-update');
        $this->validate($request, [
            'title_bn' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $date = date('d M', strtotime($request->event_date));
        $date = $this->banglaDate->bn_date($date);
        if (empty($request->event_date)) {
            $date = $event->event_date;
        }

        $time = $request->start_date;
        if(!empty($time)){
            $time = date('h:i A', strtotime($request->start_date));
            $start_time = $this->banglaDate->bn_time($time);
        }else{
            $start_time = $event->start_time;
        }

        $time = $request->end_date;
        if(!empty($time)){
            $time = date('h:i A', strtotime($time));
            $end_time = $this->banglaDate->bn_time($time);
        }else{
            $end_time = $event->end_time;
        }


        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('events/')) {
                Storage::disk('public')->makeDirectory('events/');
            }
            $makImage = Image::make($image)->resize(368, 304)->stream();
            Storage::disk('public')->put('events/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('events/' . $event->image)) {
                Storage::disk('public')->delete('events/' . $event->image);
            }
        }

        if (empty($imageName) && !empty($event->image)) {
            $imageName = $event->image;
        }

        $event->update([
            'title_bn' => $request->title_bn,
            'image' => $imageName,
            'event_date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        notify()->success("Event Update", "Success");
        return redirect()->route('app.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Gate::authorize('event-delete');
        if (Storage::disk('public')->exists('events/' . $event->image)) {
            Storage::disk('public')->delete('events/' . $event->image);
        }
        $event->delete();
        notify()->success("Event Deleted", "Success");
        return back();
    }
}
