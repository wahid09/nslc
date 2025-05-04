<?php

namespace App\Http\Controllers\LadiesClub\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AttendanceReportController extends Controller
{
    public function index()
    {
        return view('ladiesClub.report.attendanceReport.reportList');
    }

    public function attendanceSearch(Request $request)
    {
        if ($request->ajax()) {
            //$query = AttLogModel::query();
            $query = DB::table('attendance_logs')
                ->join('membership_information', 'attendance_logs.id_card_no', '=', 'membership_information.id_card_number')
                ->join('users', 'membership_information.user_id', '=', 'users.id')
                ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
                ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
                ->join('devices', 'attendance_logs.device_id', '=', 'devices.id')
                ->select('attendance_logs.attend_date',
                    'attendance_logs.badge_number',
                    'membership_information.id_card_number',
                    'users.name',
                    'users.phone',
                    'spouse_information.spouse_name_en',
                    'spouse_information.spouse_phone_number',
                    'ranks.name as rank_name',
                    'users.membership_no',
                    'devices.device_name'
                );

            if ($request->from_date !== null && $request->to_date !== null) {
                $query->whereBetween('attend_date', [$request->from_date, $request->to_date]);
            }

            if ($request->membership_no !== null) {
                $query->where('users.membership_no', $request->membership_no);
            }

            if ($request->member_name !== null) {
                $query->where('users.name', 'like', '%' . $request->member_name . '%');
            }

//            if ($request->device_id !== null) {
//                $query->where('device_id', $request->device_id);
//            }

//            if (Auth::User()->club_id != 0) {
//                $query->where('club_id', Auth::User()->club_id);
//            }

            $query->orderBy('attend_date', 'asc')->orderBy('rank_order', 'ASC');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('badge_number', function ($data) {
                    return isset($data->badge_number) ? $data->badge_number : '';
                })
                ->addColumn('membership_no', function ($data) {
                    return $data->membership_no ?? '';
                })
                ->addColumn('member_name', function ($data) {
                    return $data->name ?? '';
                })
                ->addColumn('spouse_name_en', function ($data) {
                    return $data->spouse_name_en ?? '';
                })
                ->addColumn('rank_name', function ($data) {
                    return $data->rank_name ?? '';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '';
                })
                ->addColumn('auth_date', function ($data) {
                    return Carbon::parse($data->attend_date)->format('M d, Y');
                })
                ->addColumn('auth_time', function ($data) {
                    return Carbon::parse($data->attend_date)->format('h:i:s A');
                })
                ->addColumn('device', function ($data) {
                    return $data->device_name ?? '';
                })
//                ->addColumn('type', function ($data) {
//                    return $data->purpose == 1 ? 'Auto' : 'Manual';
//                })
                ->rawColumns(['membership_no', 'member_name', 'auth_time', 'auth_date', 'device'])
                ->make(true);
        }
    }
}
