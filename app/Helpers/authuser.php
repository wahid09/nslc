<?php

if (!function_exists('authuser')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function authuser()
    {
        $authInfo = DB::table('users')
                    ->join('clubs', 'users.club_id', '=', 'clubs.id')
                    ->join('areas', 'users.area_id', '=', 'areas.id')
                    ->select('users.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name')
                    ->where('users.status', 1)
                    ->where('users.id', Auth::user()->id)
                    ->first();
        return $authInfo;
    }
}
