<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ChipCalender;
use App\Models\Club;
use App\Models\Course;
use App\Models\CourseResult;
use App\Models\Notice;
use App\Models\pageContent;
use App\Models\Policy;
use App\Models\User;
use DB;
use App\Models\Area;
use App\Models\Page;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShowRoome;
use App\Models\sobanetry;
use App\Models\Training;
use App\Models\gallery;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class SapoxController extends Controller
{
    public function index()
    {
        $prodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'appointments.name_bn')
            ->where('sobanetries.appointment_id', '=', 1)
            ->where('sobanetries.status', 1)
            ->first();
        $upoprodanpris = DB::table('sobanetries')
            ->join(
                'appointments',
                'sobanetries.appointment_id',
                '=',
                'appointments.id'
            )
            ->select(
                'sobanetries.*',
                'appointments.name_bn'
            )
            ->where('sobanetries.appointment_id', '=', 2)
            ->where('sobanetries.status', 1)
            ->first();
        $prodansomonnoykari = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 6)
            ->where('clubs.id', '=', 1)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', 1)
            ->first();
        $upoprodansomonnoykari = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 7)
            ->where('clubs.id', '=', 1)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', 1)
            ->first();
        $koshadokko = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 8)
            ->where('clubs.id', '=', 1)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', 1)
            ->first();
        $jco = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->select('sobanetries.*', 'appointments.name_bn as appt_name', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('sobanetries.appointment_id', '=', 9)
            ->where('clubs.id', '=', 1)
            ->where('sobanetries.area_id', '=', 15)
            ->where('sobanetries.status', 1)
            ->first();
        //return $jco;
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id = 1";
        $events = DB::select($sql);
        //return $events;
        //$programs = Page::find(4)->program()->active()->latest()->get();
        $programs = DB::table('programs')
            ->join('clubs', 'programs.club_id', '=', 'clubs.id')
            ->join('areas', 'programs.area_id', '=', 'areas.id')
            ->select('programs.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 1)
            ->where('programs.status', 1)
            ->latest()->get();
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', 1)
            ->where('welfares.status', 1)
            ->latest()->get();
        //return $welfares;
        //$programText = Page::find(4)->program()->active()->first();
        $programText = DB::table('clubs')->where('id', 1)->latest()->first();
        //return $programText;
        $areas = Area::active()->where('id', '!=', 15)->get();
        $membership = Page::find(4)->pageContent()->first();
        //return $membership;
        $galleries = DB::table('galleries')
            ->where('area_id', 15)
            ->where('club_id', 1)
            ->get();
        $chif_event = ChipCalender::active()->get();
        //return $chif_event;
        return view('frontend.sapox.sapox', compact('events', 'programText', 'programs', 'areas', 'membership', 'prodanpris', 'upoprodanpris', 'prodansomonnoykari', 'upoprodansomonnoykari', 'koshadokko', 'jco', 'welfares', 'galleries', 'chif_event'));
    }

    public function aboutSapox()
    {
        /*
        $areas = Area::active()->get();
        $purpose = Page::find(6)->pageContent()->active()->first();
        //return $purpose;
        $senapricity = Page::find(7)->pageContent()->active()->first();
        $areaCount = Area::all()->count();
        $userCount = User::all()->count();
        $trainingCount = Training::all()->count();
        //return  $trainingCount;
        */
        $prodanpris = DB::table('sobanetries')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'appointments.name_bn')
            ->where('sobanetries.appointment_id', '=', 1)
            ->first();
        $upoprodanpris = DB::table('sobanetries')
            ->join(
                'appointments',
                'sobanetries.appointment_id',
                '=',
                'appointments.id'
            )
            ->select(
                'sobanetries.*',
                'appointments.name_bn'
            )
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
            ->where('sobanetries.club_id', '=', 1)
            ->take(18)->get();
        //return $leaders;
        $areas = Area::active()->where('id', '!=', 15)->get();
        $area = Area::where('id', '=', 15)->first();
        $purpose = Page::find(6)->pageContent()->active()->first();
        $areaCount = Area::all()->count();
        $userCount = User::all()->count();
        $trainingCount = Training::all()->count();
        return view('frontend.sapox.about-sapox', compact('prodanpris', 'upoprodanpris', 'leaders', 'areas', 'purpose', 'areaCount', 'userCount', 'trainingCount', 'area'));
    }

    public function shawroomeSapox($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        //$showroomes = ShowRoome::active()->get();
        $showroomes = DB::table('show_roomes')
            ->where('area_id', $id)
            ->where('status', 1)
            ->get();
        return view('frontend.sapox.showroome', compact('showroomes', 'area'));
    }

    public function detailsSapox($id)
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
            ->where('club_id', 1)
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
            ->where('club_id', 1)
            ->where('appointment_id', '=', 3)
            ->first();
        //print_r($sobanerty);
        //exit;
        $shosobanerty = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 4)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $uposhosobanerty = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->whereIn('appointment_id', [17, 5])
            ->orderBy('seniority_order', 'asc')
            ->get();
        //return $uposhosobanerty;
        $socib = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 10)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $koshadokko = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 14)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $koshadokkoArea = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 13)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $memberArea = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 17)
            ->orderBy('seniority_order', 'asc')
            ->get();
        $officerArea = DB::table('sobanetries')
            ->join('areas', 'sobanetries.area_id', '=', 'areas.id')
            ->join('clubs', 'sobanetries.club_id', '=', 'clubs.id')
            ->join('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('sobanetries.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name', 'appointments.name_bn as appt_name')
            ->where('area_id', $id)
            ->where('sobanetries.status', 1)
            ->where('club_id', 1)
            ->where('appointment_id', '=', 14)
            ->orderBy('seniority_order', 'asc')
            ->get();
        //return $sobanerty;

        $trainings = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 1)
            ->where('training_categorie_id', 1)
            ->where('trainings.status', 1)
            ->get();
        //return $trainings;
        $visits = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 1)
            ->where('training_categorie_id', 2)
            ->where('trainings.status', 1)
            ->get();
        $upcommingEvents = DB::table('trainings')
            ->join('areas', 'area_id', '=', 'areas.id')
            ->join('clubs', 'club_id', '=', 'clubs.id')
            ->select('trainings.*', 'areas.name_bn as area_name', 'clubs.name_bn as club_name')
            ->where('area_id', $id)
            ->where('club_id', 1)
            ->where('training_categorie_id', 3)
            ->where('trainings.status', 1)
            ->get();
        //return $upcommingEvents;
        $welfares = DB::table('welfares')
            ->join('clubs', 'welfares.club_id', '=', 'clubs.id')
            ->join('areas', 'welfares.area_id', '=', 'areas.id')
            ->select('welfares.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
            ->where('club_id', '=', 1)
            ->where('area_id', '=', $id)
            ->where('welfares.status', 1)
            ->latest()->get();
        //return $welfares;
        return view('frontend.sapox.details-sapox', compact(
            'welfares',
            'leaders',
            'trainings',
            'area',
            'visits',
            'upcommingEvents',
            'sobanerty',
            'shosobanerty',
            'uposhosobanerty',
            'socib',
            'koshadokko',
            'koshadokkoArea',
            'memberArea',
            'officerArea'
        ));
    }

    public function gallerySapox($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $galleries = DB::table('galleries')
            ->where('area_id', $id)
            ->where('club_id', 1)
            ->where('status', 1)
            ->get();
        //return $galleries;
        return view('frontend.sapox.gallery', compact('galleries', 'area'));
    }

    public function productSapox($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $categories = Category::active()->get();
        $products = DB::table('products')
            ->where('area_id', $id)
            ->where('status', 1)
            ->get();
        //return $products;
        return view('frontend.sapox.product', compact('categories', 'products', 'area'));
    }

    public function download($path)
    {
        $path = storage_path() . '/' . 'app' . '/' . 'public' . '/policy/' . $path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }

    public function policy()
    {
        //$policy = Policy::all();
        $policies = DB::table('policies')
            ->join('clubs', 'policies.club_id', '=', 'clubs.id')
            ->select('policies.*', 'clubs.name_bn as club_name')
            ->where('policies.status', 1)
            ->where('policies.corected', 0)
            ->orderByRaw('club_id ASC')
            ->latest()->get();
        //return $policy;
        return view('frontend.policy.policy', compact('policies'));
    }

    public function corectedPolicy()
    {
        //$policy = Policy::all();
        $policies = DB::table('policies')
            ->join('clubs', 'policies.club_id', '=', 'clubs.id')
            ->select('policies.*', 'clubs.name_bn as club_name')
            ->where('policies.status', 1)
            ->where('policies.corected', 1)
            ->orderByRaw('club_id ASC')
            ->latest()->get();
        //return $policy;
        return view('frontend.policy.corected-policy', compact('policies'));
    }

    public function calenderSapox($id)
    {
        $sql = "select groupId, title, start, start_time, end from calenders where status = 1 AND club_id = 1 AND area_id = $id";
        $events = DB::select($sql);
        //return $events;
        $area = DB::table('areas')->where('id', $id)->first();
        return view('frontend.sapox.sapox-calender', compact('area', 'events'));
    }

    public function kolkonthoClub($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        //$purposeOfkolkonto = pageContent::where('id', 13)->first();
        $purposeOfkolkonto = DB::table('page_contents')->join('pages', 'page_contents.page_id', '=', 'pages.id')->select('page_contents.*')->where('page_contents.page_id', '=', 13)->where('page_contents.status', '=', 1)->first();
        //return $purposeOfkolkonto->id;
        $education_act = DB::table('education')->join('clubs', 'education.club_id', '=', 'clubs.id')->select('education.*')->where('education.club_id', '=', 4)->where('education.area_id', '=', $id)->where('education.status', '=', 1)->first();
        $galleries = DB::table('galleries')->join('clubs', 'galleries.club_id', '=', 'clubs.id')->select('galleries.*')->where('galleries.club_id', '=', 4)->where('galleries.area_id', '=', $id)->where('galleries.status', '=', 1)->latest()->get();
        //return $galleries;
        $notices = DB::table('notices')->join('clubs', 'notices.club_id', '=', 'clubs.id')->select('notices.*')->where('notices.club_id', '=', 4)->where('notices.area_id', '=', $id)->where('notices.status', '=', 1)->where('notices.private', '=', 0)->latest()->get();
        //return $notices;
        return view('frontend.sapox.kolkonthoclub', compact('area', 'purposeOfkolkonto', 'education_act', 'galleries', 'notices'));
    }

    public function others($id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        $notices = DB::table('notices')->join('clubs', 'notices.club_id', '=', 'clubs.id')->select('notices.*')->where('notices.club_id', '=', 1)->where('notices.area_id', '=', $id)->where('notices.status', '=', 1)->where('notices.private', '=', 0)->latest()->get();
        //return $notices;
        return view('frontend.sapox.others', compact('area', 'notices'));
    }
    public function courseList(){
        $courses = Course::active()->get();
        return view('frontend.sapox.courseList', [
            'courses' => $courses
        ]);
    }
    public function courseResult(){
        $courseResult = \Illuminate\Support\Facades\DB::table('course_results')
            ->join('courses', 'course_results.course_id', '=', 'courses.id')
            ->select('course_results.*', 'courses.course_name')
            ->get();
        return view('frontend.sapox.courseResult', [
            'courseResult' => $courseResult
        ]);
    }
    public function getFile($path){
        $path = storage_path().'/'.'app'.'/'.'public'.'/result/'.$path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }
}
