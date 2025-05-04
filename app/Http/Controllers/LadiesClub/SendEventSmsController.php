<?php

namespace App\Http\Controllers\LadiesClub;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Event;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Jobs\SendSmsJob;
use App\Services\SMSService;

class SendEventSmsController extends Controller
{
    public function index(){
        $events = Event::select('id', 'title_bn')->where('status', 1)
            ->where('club_id', 2)
            ->where('area_id', Auth::user()->area_id)
            ->get();
        //dd($events);
        $areas = Area::active()->select('id', 'name')->get();
        return view('ladiesClub.sms.index', [
            'events' => $events,
            'areas' => $areas
        ]);
    }
    public function getEventsByArea($area_id){
        $events = Event::active()->where('area_id', $area_id)
            ->where('club_id', 2)->select('id', 'title_bn')->get();
        return response()->json($events);
    }
    public function sendSms(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);
        if(!empty($request->get('event_id'))){
            $additionalMessage = 'To send your interest in attending the event, please reply "Yes" or "No" using this link: https://slc.army.mil.bd/app/member-event-view/' . $request->get('event_id');
        }else{
            $additionalMessage = '';
        }
        $plainTextMessage = strip_tags($request->get('message')) .'.  ' .$additionalMessage;
        $userPhnList = User::select('phone')
            ->where('club_id', 2)
            ->where('area_id', $request->get('area_id'))
            ->where('status', 1)
            ->where('is_ladies_club_member', 1)
            ->whereNotNull('phone')
            ->get();

//        foreach ($userPhnList as $number) {
//            $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
//                'username' => 'ITDAHQAdmin_3753',
//                'password' => 'ITdte@2020',
//                'apicode' => '1',
//                'cli' => 'IT DTE',
//                'countrycode' => '880',
//                'msisdn' => $number->phone,
//                'messagetype' => '1',
//                'message' => $plainTextMessage,
//                'messageid' => '0'
//            ]);
//
//            if ($response->successful()) {
//                \Log::info('SMS sent successfully', ['to' => $number->phone]);
//            } else {
//                \Log::error('SMS failed', [
//                    'to' => $number->phone,
//                    'response' => $response->body(),
//                    'status' => $response->status()
//                ]);
//            }
//        }
        foreach ($userPhnList as $user) {
            dispatch(new SendSmsJob($user->phone, $plainTextMessage));
        }
        //return response()->json(['success' => true, 'message' => 'SMS sent to all valid numbers.']);
        notify()->success("SMS send successfully", "Success");
        return redirect()->back();
    }

    public function inPersonSMS(){
        return view('ladiesClub.sms.inPersonSms');
    }
    public function inPersonSMSSend(Request $request, SMSService $sms){
        $request->validate([
            'message' => 'required|string',
            'phone_number' => 'required'
        ]);
        $plainTextMessage = strip_tags($request->get('message'));
        $sms->sendSMS($request->get('phone_number'), $plainTextMessage);
        notify()->success("SMS send successfully", "Success");
        return redirect()->back();
    }
}
