<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    protected $client;


    public function sendSMS($to, $message)
    {
        $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
            'username' => 'ITDAHQAdmin_3753',
            'password' => 'ITdte@2020',
            'apicode' => '1',
            'cli' => 'IT DTE',
            'countrycode' => '880',
            'msisdn' => $to,
            'messagetype' => '1',
            'message' => $message,
            'messageid' => '0'
        ]);
    }
}
