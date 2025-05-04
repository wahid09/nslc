<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\pageContent;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $pageContents = Page::find(2)->pageContent;
        //dd($pageContents);
        return view('frontend.about-us.about', compact('pageContents'));
    }
}
