<?php

if (!function_exists('permission')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function permission()
    {
        $userRoleName = \App\Models\User::findOrFail(Auth::user()->id)->role->slug;
        return $userRoleName;

    }
}
