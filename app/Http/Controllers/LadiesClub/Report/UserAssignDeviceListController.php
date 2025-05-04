<?php

namespace App\Http\Controllers\LadiesClub\Report;

use App\Http\Controllers\Controller;
use App\Models\UserAssignDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class UserAssignDeviceListController extends Controller
{
    public function index()
    {
        return view('ladiesClub.report.userAssignDevice.userAssignDeviceList');
    }

    public function sreachMemberDevice(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('user_assign_devices')
                ->join('users', 'user_assign_devices.user_id', '=', 'users.id')
                ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
                ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
                ->join('devices', 'user_assign_devices.device_id', '=', 'devices.id')
                ->select('user_assign_devices.id_card_number',
                    'users.name',
                    'user_assign_devices.status',
                    'user_assign_devices.club_id',
                    'user_assign_devices.area_id',
                    'user_assign_devices.created_at',
                    'devices.device_name',
                    'users.membership_no',
                    'users.phone',
                    'spouse_information.spouse_name_en',
                    'spouse_information.spouse_phone_number',
                    'ranks.name as rank_name'
                )
            ->orderBy('ranks.rank_order', 'ASC');
            if ($request->device_id !== null) {
                $query->where('user_assign_devices.device_id', $request->device_id);
            }
            if ($request->rank_id !== null) {
                $query->where('ranks.id', $request->rank_id);
            }
            if ($request->status !== null) {
                $query->where('user_assign_devices.status', $request->status);
            }

//            $query->orderBy('updated_at', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                // ->addColumn('member', function ($data) {
                //     return $data->member ? $data->member->fullname : $data->member2->fullname;
                // })
                ->addColumn('membership_no', function ($data) {
                    return $data->membership_no ?? '';
                })
                ->addColumn('name', function ($data) {
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
                ->addColumn('card_id', function ($data) {
                    return $data->id_card_number ?? '';
                })
                ->addColumn('auth_date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->addColumn('auth_time', function ($data) {
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })->addColumn('device', function ($data) {
                    return $data->device_name;
                })
                ->filterColumn('membership_no', function ($query, $keyword) {
                    $query->where('users.membership_no', 'like', "%{$keyword}%");
                })
                ->filterColumn('id_card_number', function ($query, $keyword) {
                    $query->where('user_assign_devices.id_card_number', 'like', "%{$keyword}%");
                })
                ->rawColumns(['membership_no', 'card_id', 'auth_time', 'auth_date', 'device'])
                ->make(true);
        }
    }
}
