<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Prokasone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PublicationController extends Controller
{
    public function index(){
        $publications = Prokasone::active()->latest()->get();
        //return $publications;
        return view('frontend.publication', compact('publications'));
    }
    public function download($path){
        $path = storage_path().'/'.'app'.'/'.'public'.'/publication/'.$path;
        if (file_exists($path)) {
            return Response::download($path);
        }
        return back();
    }
}
