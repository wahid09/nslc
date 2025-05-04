<?php

namespace App\Http\Controllers\ladiesClub;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MemberEventAttendListController extends Controller
{
    public function index()
    {
        return view('ladiesClub.memberListWithCode.list');
    }
    public function sreachMemberWithCode(Request $request){
        if ($request->ajax()) {
            $query = \DB::table('member_attend_events')
                ->join('users', 'member_attend_events.user_id', '=', 'users.id')  // Corrected here
                ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
                ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
                ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
                ->join('events', 'member_attend_events.event_id', '=', 'events.id')
                ->select(
                    'member_attend_events.id',
                    'member_attend_events.event_code',
                    'users.name',
                    'users.membership_no',
                    'users.phone',
                    'spouse_information.spouse_ba_no',
                    'ranks.name as rank_name',
                    'spouse_information.spouse_name_en',
                    'membership_information.id_card_number',
                    'users.status',
                    'events.title_bn as event_name'
                )
                ->where('member_will_attend', 1)
                ->where('member_attended', 0)
                ->orderBy('ranks.rank_order', 'ASC');
            if ($request->event_id !== null) {
                $query->where('member_attend_events.event_id', $request->event_id);
            }
            if ($request->rank_id !== null) {
                $query->where('ranks.id', $request->rank_id);
            }
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('membership_no', function ($data) {
                    return $data->membership_no ?? '';
                })
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })
                ->addColumn('spouse_name_en', function ($data) {
                    return $data->spouse_name_en ?? '';
                })
                ->addColumn('spouse_ba_no', function ($data) {
                    return $data->spouse_ba_no ?? '';
                })
                ->addColumn('rank_name', function ($data) {
                    return $data->rank_name ?? '';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '';
                })
                ->addColumn('id_card_number', function ($data) {
                    return $data->id_card_number ?? '';
                })
                ->addColumn('event_name', function ($data) {
                    return $data->event_name ?? '';
                })
                ->addColumn('event_code', function ($data) {
                    return $data->event_code ?? '';
                })
                ->addColumn('actions', function ($data) {
                    $editBtn = '<a href="javascript:void(0)" class="btn btn-sm btn-primary update-attendance" data-id="' . $data->id . '" title="Mark Attended">
                    <i class="fas fa-arrow-circle-up"></i>
                </a>';

                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-member" data-id="' . $data->id . '" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>';

                    return $editBtn . ' ' . $deleteBtn;
                })
                ->filterColumn('membership_no', function ($query, $keyword) {
                    $query->where('users.membership_no', 'like', "%{$keyword}%");
                })
                ->filterColumn('id_card_number', function ($query, $keyword) {
                    $query->where('membership_information.id_card_number', 'like', "%{$keyword}%");
                })
                ->filterColumn('event_code', function ($query, $keyword) {
                    $query->where('member_attend_events.event_code', 'like', "%{$keyword}%");
                })
                ->rawColumns(['membership_no', 'member_name', 'spouse_name', 'ba_no', 'spouse_rank', 'member_contact_no', 'card_no', 'event_name', 'actions'])
                ->make(true);
        }
    }

    public function isAttend($id)
    {
        if (!empty($id)) {
            \DB::table('member_attend_events')
                ->where('id', $id)
                ->update([
                    'member_attended' => 1
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Attendance status updated.',
            ]);
        }
    }
    public function getAttendedMemberList(){
        return view('ladiesClub.eventAttendedMemberList.list');
    }
    public function getAttendedMemberSearch(Request $request){
        if ($request->ajax()) {
            $query = \DB::table('member_attend_events')
                ->join('users', 'member_attend_events.user_id', '=', 'users.id')  // Corrected here
                ->join('spouse_information', 'users.id', '=', 'spouse_information.user_id')
                ->join('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
                ->join('membership_information', 'users.id', '=', 'membership_information.user_id')
                ->join('events', 'member_attend_events.event_id', '=', 'events.id')
                ->select(
                    'member_attend_events.id',
                    'member_attend_events.event_code',
                    'users.name',
                    'users.membership_no',
                    'users.phone',
                    'spouse_information.spouse_ba_no',
                    'ranks.name as rank_name',
                    'spouse_information.spouse_name_en',
                    'membership_information.id_card_number',
                    'users.status',
                    'events.title_bn as event_name'
                )
                //->where('member_will_attend', 1)
                //->where('member_attended', 1)
                ->orderBy('ranks.rank_order', 'ASC');
            if ($request->attend !== null) {
                $query->where('member_attend_events.member_attended', $request->attend);
            }
            if ($request->event_id !== null) {
                $query->where('member_attend_events.event_id', $request->event_id);
            }
            if ($request->rank_id !== null) {
                $query->where('ranks.id', $request->rank_id);
            }
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('membership_no', function ($data) {
                    return $data->membership_no ?? '';
                })
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })
                ->addColumn('spouse_name_en', function ($data) {
                    return $data->spouse_name_en ?? '';
                })
                ->addColumn('spouse_ba_no', function ($data) {
                    return $data->spouse_ba_no ?? '';
                })
                ->addColumn('rank_name', function ($data) {
                    return $data->rank_name ?? '';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '';
                })
                ->addColumn('id_card_number', function ($data) {
                    return $data->id_card_number ?? '';
                })
                ->addColumn('event_name', function ($data) {
                    return $data->event_name ?? '';
                })
                ->addColumn('event_code', function ($data) {
                    return $data->event_code ?? '';
                })
                ->addColumn('actions', function ($data) {
                    $editBtn = '<a href="javascript:void(0)" class="btn btn-sm btn-primary update-attendance" data-id="' . $data->id . '" title="Mark Attended">
                    <i class="fas fa-arrow-circle-up"></i>
                </a>';

                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-member" data-id="' . $data->id . '" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>';

                    return $editBtn . ' ' . $deleteBtn;
                })
                ->filterColumn('membership_no', function ($query, $keyword) {
                    $query->where('users.membership_no', 'like', "%{$keyword}%");
                })
                ->filterColumn('id_card_number', function ($query, $keyword) {
                    $query->where('membership_information.id_card_number', 'like', "%{$keyword}%");
                })
                ->filterColumn('event_code', function ($query, $keyword) {
                    $query->where('member_attend_events.event_code', 'like', "%{$keyword}%");
                })
                ->rawColumns(['membership_no', 'member_name', 'spouse_name', 'ba_no', 'spouse_rank', 'member_contact_no', 'card_no', 'event_name', 'actions'])
                ->make(true);
        }
    }
}
