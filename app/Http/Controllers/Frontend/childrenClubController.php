<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ChipCalender;
use DB;
use App\Models\Area;
use App\Models\Page;
use App\Models\sobanetry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class childrenClubController extends Controller
{
    public function index()
    {
        //        $prodanpris = DB::table('sobanetries')
        //            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
        //            ->select('sobanetries.*', 'appointments.name_bn')
        //            ->where('sobanetries.appointment_id', '=', 1)
        //            ->first();
        $prodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'clubs.name_bn as club name')
            ->where('sobanetries.appointment_id', '=', 1)
            ->where('sobanetries.club_id', '=', 3)
            ->where('sobanetries.status', '=', 1)
            ->first();
        //return $prodanpris;
        $prodansomonnoykari = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 6)
            ->where('clubs.id', '=', 3)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', '=', 1)
            ->first();
        //return $prodansomonnoykari;
        $upoprodansomonnoykari = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 7)
            ->where('clubs.id', '=', 3)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', '=', 1)
            ->first();
        //return $upoprodansomonnoykari;
        $socib = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 10)
            ->where('clubs.id', '=', 3)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', '=', 1)
            ->first();

        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id=3";
        $events = DB::select($sql);
        //return $events;
        //$programs = Page::find(4)->program()->active()->latest()->get();
        $programs = DB::table('programs')
            ->join('clubs', 'programs.club_id', '=', 'clubs.id')
            ->join('areas', 'programs.area_id', '=', 'areas.id')
            ->select('programs.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 3)
            ->where('programs.status', 1)
            ->latest()->get();
        //return $programs;
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 3)
            ->where('welfares.status', 1)
            ->latest()->get();
        //$programText = Page::find(4)->program()->active()->first();
        $programText = DB::table('clubs')->where('id', 3)->latest()->first();
        //return $programText;
        $areas = Area::active()->where('id', '!=', 15)->get();
        $membership = Page::find(12)->pageContent()->first();
        $chif_event = ChipCalender::active()->get();
        $galleries = DB::table('galleries')
            ->where('area_id', 15)
            ->where('club_id', 3)
            ->get();
        return view('frontend.children.home', compact('events', 'programText', 'programs', 'areas', 'membership', 'prodanpris', 'prodansomonnoykari', 'upoprodansomonnoykari', 'socib', 'welfares', 'chif_event', 'galleries'));
    }
    public function detailsChildrenclub($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        //dd($area);
        $leaders = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('appointment_id', '!=', 1)
            ->where('appointment_id', '!=', 2)
            ->where('appointment_id', '!=', 3)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('sobanetries.status', 1)
            ->take(12)
            ->get();
        //return $leaders;
        $sobanerty = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('appointment_id', '!=', 1)
            ->where('appointment_id', '!=', 2)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 3)
            ->first();
        //return $sobanerty;
        $shosobanerty = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 4)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $socib = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 10)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $culturalLead = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 12)
            ->orderBy('seniority_order', 'asc')
            ->get();
        //return $culturalLead;
        $koshadokko = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 13)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $somonnoykariOfficer = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 14)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $proactiveMember = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 17)
            ->orderBy('seniority_order', 'asc')
            ->get();

        $interestedMembers = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 3)
            ->where('appointment_id', '=', 15)
            ->orderBy('seniority_order', 'asc')
            ->get();

        //dd($interestedMembers);

        $trainings = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 3)
            ->where('training_categorie_id', 1)
            ->where('trainings.status', 1)
            ->get();
        //return $trainings;
        $visits = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 3)
            ->where('training_categorie_id', 2)
            ->where('trainings.status', 1)
            ->get();
        $upcommingEvents = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 3)
            ->where('training_categorie_id', 3)
            ->where('trainings.status', 1)
            ->get();
        //return $upcommingEvents;
        $ldetails = Page::find(11)->pageContent()->first();
        //return $ldetails;
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', '=', 3)
            ->where('area_id', '=', $id)
            ->where('welfares.status', 1)
            ->latest()->get();
        return view('frontend.children.details-childrenclub', compact(
            'leaders',
            'trainings',
            'area',
            'visits',
            'upcommingEvents',
            'sobanerty',
            'ldetails',
            'shosobanerty',
            'socib',
            'culturalLead',
            'koshadokko',
            'somonnoykariOfficer',
            'proactiveMember',
            'welfares',
            'interestedMembers'
        ));
    }
    public function childrenclubGallery($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $galleries = DB::table('galleries')
            ->where('area_id', $id)
            ->where('club_id', 3)
            ->where('status', 1)
            ->get();
        return view('frontend.children.gallery', compact('galleries', 'area'));
    }
    public function aboutChildrenclub()
    {
        /*
        $prodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'appointments.name_bn')
            ->where('sobanetries.appointment_id', '=', 1)
            ->first();
        */
        $upoprodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'appointments.name_bn')
            ->where('sobanetries.appointment_id', '=', 2)
            ->first();
        $leaders = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '!=', 1)
            ->where('sobanetries.appointment_id', '!=', 2)
            ->where('sobanetries.appointment_id', '=', 3)
            ->where('sobanetries.club_id', '=', 3)
            ->take(18)->get();
        $areas = Area::active()->where('id', '!=', 15)->get();
        $area = Area::active()->where('id', '=', 15)->first();
        $about = Page::find(8)->pageContent()->active()->first();
        //return $about;
        return view('frontend.children.about', compact('upoprodanpris', 'leaders', 'areas', 'about', 'area'));
    }
    public function download($path)
    {
        $path = storage_path() . '/' . 'app' . '/' . 'public' . '/policy/' . $path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }
    public function childrenclubCalender($id)
    {
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id = 3 AND area_id = $id";
        $events = DB::select($sql);
        $area = DB::table('areas')->where('id', $id)->first();
        return view('frontend.children.calender', compact('area', 'events'));
    }
    public function childrenClubNotice($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $notices = DB::table('notices')->join('clubs', 'notices.club_id', '=', 'clubs.id')->select('notices.*')->where('notices.club_id', '=', 3)->where('notices.area_id', '=', $id)->where('notices.status', '=', 1)->where('notices.private', '=', 0)->latest()->get();
        //return $notices;
        return view('frontend.children.notice', compact('area', 'notices'));
    }
}