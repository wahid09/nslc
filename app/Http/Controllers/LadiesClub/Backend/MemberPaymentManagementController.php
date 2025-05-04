<?php

namespace App\Http\Controllers\LadiesClub\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberPaymentManagementController extends Controller
{
    public function index()
    {
        $payments = DB::table('member_payments')
            ->join('users', 'member_payments.user_id', '=', 'users.id')
            ->select(
                'member_payments.id',
                'member_payments.pay_month',
                'member_payments.pay_amount',
                'member_payments.document',
                'member_payments.ref_no',
                'member_payments.payment_is_verified',
                'users.name',
                'users.name_bn'
            )
            ->get();
        //dd($payments);
        return view('backend.payment.index', [
            'payments' => $payments
        ]);
    }
    public function paymentUpdate($id)
    {
        $updated = DB::table('member_payments')->where('id', $id)->update([
            'payment_is_verified' => 1
        ]);
        return response()->json($updated);
    }
}
