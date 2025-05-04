<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;

class PollController extends Controller
{

    public  function PollLogin(){

        $pollSystemUrl='https://www.google.com';

        $authData=Auth::user();

        $pollLoginRequest=array();
        $pollLoginRequest['MemberID']=$authData->id;
        $pollLoginRequest['MemberName']=$authData->name;
        $pollLoginRequest['MemberEmail']=$authData->email;

//        return $pollLoginRequest;
//        $response = Http::post($pollSystemUrl, $pollLoginRequest);
//        return redirect('https://google.com');

    }
}
