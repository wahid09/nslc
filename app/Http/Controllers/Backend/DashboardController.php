<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Gate::authorize('access-dashboard');
        if (permission() == 'system-admin') {
            $users = User::with('club', 'area')->get();
        } elseif (permission() == 'super-admin') {
            $users = User::with('club', 'area')
                ->where('club_id', Auth::user()->club_id)->get();
        } else {
            $users = User::with('club', 'area')
                ->where('club_id', Auth::user()->club_id)
                ->where('area_id', Auth::user()->area_id)
                ->get();
        }
        $sapoxUsers = User::where('club_id', 1)->get();
        $sapoxUser = $sapoxUsers->count();
        $leadisClubUsers = User::where('club_id', 2)->get();
        $leadisClubUser = $leadisClubUsers->count();
        $childernClubUsers = User::where('club_id', 3)->get();
        $childernClubUser = $childernClubUsers->count();
        //return $users;
        return view('backend.dashboard', compact('users', 'sapoxUser', 'leadisClubUser', 'childernClubUser'));
}
}
