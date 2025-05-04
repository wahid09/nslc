<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SociaLinkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SocialLinkController extends Controller
{
    public function index(){
        Gate::authorize('footer-index');
        $links = SociaLinkl::all();
        return view('backend.footers.social', compact('links'));
    }
    public function edit($id){
        Gate::authorize('footer-update');
        $links = SociaLinkl::findOrFail($id);
        return view('backend.footers.social_edit', compact('links'));
    }
    public function update(Request $request, $id){
        $data = [
            'fb_link'=>$request->fb_link,
            'twitter_link'=>$request->twitter_link,
            'instra_link'=>$request->instra_link
        ];

        $affected = DB::table('socia_linkls')
            ->where('id', $id)
            ->update($data);
        notify()->success('Update Success', 'Success');
        return back();
    }
}
