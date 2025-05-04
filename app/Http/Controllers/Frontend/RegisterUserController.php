<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Area;
use App\Models\Club;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create()
    {
        $areas = Area::active()->where('id', '!=', 15)->get();
        $clubs = Club::active()->where('id', '!=', 5)->where('id', '!=', 4)->get();
        $ranks = Rank::active()->get();
        return view('auth.register', compact('areas', 'ranks', 'clubs'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'spouse' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'area' => 'required',
            'club' => 'required',
            'rank' => 'required',
            'initial' => 'required',
            'ba_no' => 'required',
            'password' => 'required|confirmed|string|min:8'
        ]);
        $baNo = $request->initial . '-' . $request->ba_no;
        //return $baNo;

        $user = User::create([
            'username' => $request->username,
            'area_id' => $request->area,
            'rank_id' => $request->rank,
            'spouse' => $request->spouse,
            'ba_no' => $baNo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'club_id' => $request->club,
            'status' => 0,
            'role_id' => 4
        ]);
        if ($user) {
            alert()->success('আপনার নিবন্ধনটি সফলভাবে সম্পন্ন হয়েছে, একাউন্টটি সচল করার জন্য অ্যাডমিন এর সাথে যোগাযোগ করুন। ধন্যবাদ')->width('62rem')->autoClose(50000);
        }
        return redirect()->route('login');
    }
}
