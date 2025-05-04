<?php

namespace App\Http\Controllers\LadiesClub\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class getAttendanceDataController extends Controller
{
    public function getAttendanceData(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable',
            'id_card_no' => 'required',
            'attendance_time' => 'required',
            'device_id' => 'nullable',
        ]);
        if(!empty($request->input('attendance_time'))){
            $attendanceTime = $request->input('attendance_time');
           // $time = Carbon::createFromFormat('H:i', $attendanceTime);
        }else{
            $attendanceTime = null;
        }
        if(!empty($request->get('device_id'))){
            if($request->get('device_id') == 'CGKN231560049'){
                $diviceId = 1;
            }else{
                $diviceId = 2;
            }
        }else{
            $diviceId = null;
        }
        $data = DB::table('attendance_logs')->insert([
            'user_id' => $request->get('user_id'),
            'device_id' => $diviceId,
            'id_card_no' =>$request->get('id_card_no'),
            'club_id' => 2,
            'area_id' =>1,
            'badge_number'=>1,
            'attend_date' => $request->get('attendance_time'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        if($data){
            return response()->json([
                'isSuccess' => true,
                'data' => $data,
                'message' => 'successful!'
                ]);
        }else{
            return response()->json([
                'isSuccess' => false,
                'data' => [],
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
