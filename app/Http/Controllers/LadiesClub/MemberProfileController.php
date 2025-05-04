<?php

namespace App\Http\Controllers\LadiesClub;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class MemberProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $member = \DB::table('users')
            ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
            ->select('users.id as user_id',
                'users.name as member_name',
                'users.phone as member_phone',
                'users.status as user_status',
                'spouse_information.*',
                'membership_information.*',
                'ranks.id',
                'ranks.name as rank_name')
            ->where('users.id', $id)
            ->first();
        //dd($member);
        return view('ladiesClub.memberProfile.profile', [
            'member' => $member
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
