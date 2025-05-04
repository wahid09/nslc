<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Area;
use App\Models\ChipCalender;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Response;

class LadicClubController extends Controller
{
    public function index()
    {
        $prodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'clubs.name_bn as club name')
            ->where('sobanetries.appointment_id', '=', 1)
            ->where('sobanetries.club_id', '=', 2)
            ->where('sobanetries.status', 1)
            ->first();
        //return $prodanpris;
        $prodansomonnoykari = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 6)
            ->where('clubs.id', '=', 2)
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
            ->where('clubs.id', '=', 2)
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
            ->where('clubs.id', '=', 2)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', '=', 1)
            ->first();
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id=2";
        $events = DB::select($sql);
        //return $events;
        //$programs = Page::find(4)->program()->active()->latest()->get();
        $programs = DB::table('programs')
            ->join('clubs', 'programs.club_id', '=', 'clubs.id')
            ->join('areas', 'programs.area_id', '=', 'areas.id')
            ->select('programs.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 2)
            ->where('programs.status', 1)
            ->latest()->get();
        //return $programs;
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 2)
            ->where('welfares.status', 1)
            ->latest()->get();
        $programText = DB::table('clubs')->where('id', 2)->latest()->first();
        $areas = Area::active()->where('id', '!=', 15)->get();
        $membership = Page::find(10)->pageContent()->first();
        //return $membership;
        $galleries = DB::table('galleries')
            ->where('area_id', 15)
            ->where('club_id', 2)
            ->get();
        $chif_event = ChipCalender::active()->get();
        return view('frontend.ladisclub.home', compact('events', 'programText', 'programs', 'areas', 'membership', 'prodanpris', 'prodansomonnoykari', 'upoprodansomonnoykari', 'socib', 'welfares', 'galleries', 'chif_event'));
    }

    public function detailsLadiesClub($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
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
            ->where('club_id', 2)
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
            ->where('club_id', 2)
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
            ->where('club_id', 2)
            ->where('appointment_id', '=', 4)
            ->orderBy('seniority_order', 'asc')
            ->get();
        //return $shosobanerty;
        $socib = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 2)
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
            ->where('club_id', 2)
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
            ->where('club_id', 2)
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
            ->where('club_id', 2)
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
            ->where('club_id', 2)
            ->where('appointment_id', '=', 15)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $genaralSec = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 2)
            ->where('appointment_id', '=', 16)
            ->orderBy('seniority_order', 'asc')
            ->get();

        $trainings = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 2)
            ->where('training_categorie_id', 1)
            ->where('trainings.status', 1)
            ->get();
        //return $trainings;
        $visits = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 2)
            ->where('training_categorie_id', 2)
            ->where('trainings.status', 1)
            ->get();
        $upcommingEvents = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 2)
            ->where('training_categorie_id', 3)
            ->where('trainings.status', 1)
            ->get();
        //return $upcommingEvents;
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', '=', 2)
            ->where('area_id', '=', $id)
            ->where('welfares.status', 1)
            ->latest()->get();
        $ldetails = Page::find(11)->pageContent()->first();
        //return $ldetails;
        return view('frontend.ladisclub.details-ladies', compact(
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
            'genaralSec'
        ));
    }

    public function ladiesclubGallery($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $galleries = DB::table('galleries')
            ->where('area_id', $id)
            ->where('club_id', 2)
            ->where('status', 1)
            ->get();
        return view('frontend.ladisclub.gallery', compact('galleries', 'area'));
    }

    public function aboutLadisclub()
    {
        //return $jco;
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
            ->where('sobanetries.club_id', '=', 2)
            ->take(18)->get();
        $areas = Area::active()->where('id', '!=', 15)->get();
        $area = Area::active()->where('id', '=', 15)->first();
        $about = Page::find(9)->pageContent()->active()->first();
        //return $about;
        return view('frontend.ladisclub.about', compact('upoprodanpris', 'leaders', 'areas', 'about', 'area'));
    }

    public function download($path)
    {
        $path = storage_path() . '/' . 'app' . '/' . 'public' . '/policy/' . $path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }

    public function protivaSchool($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $purposeOfkolkonto = DB::table('page_contents')->join('pages', 'page_contents.page_id', '=', 'pages.id')->select('page_contents.*')->where('page_contents.page_id', '=', 14)->where('page_contents.status', '=', 1)->first();
        //return $purposeOfkolkonto;
        $education_act = DB::table('education')->join('clubs', 'education.club_id', '=', 'clubs.id')->select('education.*')->where('education.club_id', '=', 5)->where('education.area_id', '=', $id)->where('education.status', '=', 1)->first();
        $galleries = DB::table('galleries')->join('clubs', 'galleries.club_id', '=', 'clubs.id')->select('galleries.*')->where('galleries.club_id', '=', 5)->where('galleries.area_id', '=', $id)->where('galleries.status', '=', 1)->latest()->get();
        //return $galleries;
        $notices = DB::table('notices')->join('clubs', 'notices.club_id', '=', 'clubs.id')->select('notices.*')->where('notices.club_id', '=', 5)->where('notices.area_id', '=', $id)->where('notices.status', '=', 1)->where('notices.private', '=', 0)->latest()->get();
        //return $notices;
        return view('frontend.ladisclub.protivaSchool', compact('area', 'purposeOfkolkonto', 'education_act', 'galleries', 'notices'));
    }
    public function ladiesclubCalender($id)
    {
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id = 2 AND area_id = $id";
        $events = DB::select($sql);
        $area = DB::table('areas')->where('id', $id)->first();
        return view('frontend.ladisclub.ladiesclub-calender', compact('area', 'events'));
    }
    public function ladiesClubNotice($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $notices = DB::table('notices')->join('clubs', 'notices.club_id', '=', 'clubs.id')->select('notices.*')->where('notices.club_id', '=', 2)->where('notices.area_id', '=', $id)->where('notices.status', '=', 1)->where('notices.private', '=', 0)->latest()->get();
        //return $notices;
        return view('frontend.ladisclub.notice', compact('area', 'notices'));
    }
}