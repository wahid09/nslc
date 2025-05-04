<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Event;
use App\Models\Footer;
use App\Models\Message;
use App\Models\Page;
use App\Models\Program;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\VipGallery;
use DB;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $vipgalleries = VipGallery::latest()->active()->get();
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1";
        $calenderEvents = DB::select($sql);
        //return $events;
        $sliders = Slider::active()->get();
        //return $sliders;
        $messages = Message::active()->get();
        //$programs = Program::active()->latest()->take(3)->get();
        $programs = Program::with('club')->where('club_id', 1)->active()->latest()->take(6)->get();
        //return $programs;
        //$events = Event::active()->latest()->take(3)->get();
        //$toDay = Date()
        $events = Training::with('club', 'area')->where('club_id', 1)->latest()->take(6)->get();
        //return $events;
        //$pages = Page::active()->latest('slno')->get();
        $pages = Page::select("*")
            ->where('status', 1)
            ->orderBy('slno')
            ->get();
        //return $pages;
        $award = Award::active()->latest()->first();
        $sapoxText = Page::find(4);
        //return $award;
        $programText = Page::find(1)->program()->active()->first();
        $footer = Footer::first();
        //return $footer;
        return view('frontend.home', compact('sliders', 'messages', 'programs', 'events', 'pages', 'award', 'sapoxText', 'programText', 'footer', 'calenderEvents', 'vipgalleries'));
    }
    public function notice()
    {
        return view('');
    }
    public function getBani()
    {
        $messages = Message::active()->get();
        //return $messages;
        return view('frontend.messages.bani', compact('messages'));
    }
}
