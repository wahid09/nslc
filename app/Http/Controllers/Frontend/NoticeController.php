<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;

class NoticeController extends Controller
{
    public function index(){
//        if(!empty(Auth::user())){
//            $notices = Notice::active()->get();
//        }else{
//            $notices = DB::table('notices')->where('private', 0)->get();
//        }
        if(Auth()->user()->role_id == 4){
            $notices = DB::table('notices')->where('private', 0)->latest()->get();
        }else{
           //$notices = Notice::active()->get();
            $notices = DB::table('notices')->where('private', 0)->latest()->get();
        }

        //return $notices;
        return view('frontend.notice', compact('notices'));
    }
    public function getFile($path){
        $path = storage_path().'/'.'app'.'/'.'public'.'/notices/'.$path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }
    public function detailsNotice($id){
        //return $id;
        $notice = Notice::where('is_footer', 1)->where('id', '=', $id)->first();
        return view('frontend.details-notice', compact('notice'));
    }
}
