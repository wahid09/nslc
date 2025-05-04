<?php

if (!function_exists('image')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function image()
    {
        $image = DB::table('users')
            ->select('users.*')
            ->where('users.id', Auth::user()->id)
            ->first();
        return $image;
    }
}
