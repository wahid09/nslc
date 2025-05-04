<?php

namespace App\Http\Controllers\LadiesClub\IDCard;

use App\Models\Club;
use App\Models\User;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\sobanetry;
use Picqer\Barcode\BarcodeGenerator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IDCardPrintController extends Controller
{
    public function index($id)
    {
        //$member = User::findOrFail($id);
        $member = DB::table('users')
            ->leftJoin('blood_groups', 'users.blood_group_id', '=', 'blood_groups.id')
            ->leftJoin('membership_information', 'users.id', '=', 'membership_information.user_id')
            ->leftJoin('spouse_information', 'users.id', '=', 'spouse_information.user_id')
            ->leftJoin('ranks', 'spouse_information.rank_id', '=', 'ranks.id')
            ->leftJoin('user_images', 'users.id', '=', 'user_images.user_id')
            ->select(
                'users.id',
                'users.club_id',
                'users.area_id',
                'users.name',
                'users.phone',
                'users.membership_no',
                'users.image',
                'spouse_information.spouse_name_en',
                'membership_information.membership_date',
                'blood_groups.group_name',
                'spouse_information.spouse_ba_no',
                'ranks.name as sp_rank',
                'user_images.member_image',
                'user_images.member_signature'
            )
            ->where('users.id', $id)
            ->first();
        $clubDesignation = DB::table('sobanetries')
            ->leftJoin('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->select('appointments.name', 'appointments.name_bn')
            ->where('sobanetries.user_id', $id)
            ->first();
        $presidents = DB::table('sobanetries')
            ->leftJoin('appointments', 'sobanetries.appointment_id', '=', 'appointments.id')
            ->leftJoin('user_images', 'sobanetries.user_id', '=', 'user_images.user_id')
            ->select('user_images.member_signature', 'appointments.name_bn')
            ->where('sobanetries.appointment_id', 3)
            ->where('sobanetries.area_id', $member->area_id)
            ->where('sobanetries.club_id', $member->club_id)
            ->first();
        //dd($presidents);
        $clubName = Club::findOrFail($member->club_id)->name;
        $pdf = PDF::loadView('ladiesClub.idCard.idCardFront', ["member" => $member, "clubName" => $clubName, 'clubDesignation' => $clubDesignation, 'presidents' => $presidents]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($member->membership_no . '.pdf');
        //return view('ladiesClub.idCard.idCardFront');
    }
    public function idcardBack($id){
        $member = User::findOrFail($id);
        $clubData = Club::findOrFail($member->club_id);
        $qrcode = base64_encode(QrCode::format('svg')->generate($member->membership_no));
        $pdf = PDF::loadView('ladiesClub.idCard.idCardBack', ["member" => $member, "clubData" => $clubData, "qrcode" => $qrcode]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($member->membership_no . '_back' . '.pdf');
    }
}
