<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    protected $maxAttempts = 3;
    protected $decayMinutes = 5;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password', 'active' = 1);
        return [
            'email' => request()->email,
            'password' => request()->password,
            'status' => 1
        ];
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username() . ',status,1',
            'password' => 'required|string',
        ], [
            $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.'
        ]);
    }

//    public function login(Request $request)
//    {
//        $request->validate([
//            'email' => 'required',
//            'password' => 'required',
//        ]);
//
//        $credentials = $request->only('email', 'password');
//        if (Auth::attempt($credentials)) {
//
//            auth()->user()->generateCode();
//
//            return redirect()->route('2fa.index');
//        }
//
//        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
//    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'membership_no';
        $login_input = $request->input('email');

        $request->merge([$login_type => $login_input]);

        if ($login_type === 'email') {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                auth()->user()->generateCode(); // Your custom method to generate 2FA code
                return redirect()->route('2fa.index');
//                auth()->user()->membershipLoginWithoutCode();
//                $code = \DB::table('user_codes')->where('user_id', auth()->user()->id)->first();
//                if(!is_null($code)){
//                    Session::put('user_2fa', auth()->user()->id);
//                }
                //return redirect()->route('home');
                return redirect()->intended();
            }
        } else {
            $credentials = $request->only('membership_no', 'password');

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                auth()->user()->loginWithSmsOtp(); // Your custom method to generate 2FA code
                return redirect()->route('2fa.index');
//
//                auth()->user()->membershipLoginWithoutCode();
//                $code = \DB::table('user_codes')->where('user_id', auth()->user()->id)->first();
//                if(!is_null($code)){
//                    Session::put('user_2fa', auth()->user()->id);
//                }
                return redirect()->intended();
            }
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

}
