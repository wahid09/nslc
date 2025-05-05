<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\UserCode;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.2fa');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();
        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            return redirect()->route('home');
        }

        return back()->with('error', 'You entered wrong code.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        $phone = auth()->user()->phone;
        if(!$phone){
            auth()->user()->generateCode();
        }else{
            auth()->user()->loginWithSmsOtp();
        }

        return back()->with('success', 'We sent you code on your Email/Mobile Number.');
    }
}
