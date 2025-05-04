<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Club;
use App\Models\Rank;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileUpdateController extends Controller
{
    public function getProfileView(){
        $userId = Auth()->user()->id;
        //$users = User::where('id', $userId)->get();
        $users = DB::table('users')
            ->join('clubs', 'users.club_id', '=', 'clubs.id')
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->join('ranks', 'users.rank_id', '=', 'ranks.id')
            ->select('users.*', 'clubs.name_bn as club_name', 'areas.name_bn as area_name', 'ranks.name_bn as rank_name')
            ->where('users.status', 1)
            ->where('users.id', '=', Auth::user()->id)
            ->first();
        return view('frontend.profile.profile', compact('users'));
    }
    public function getProfileUpdate(){
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        $ranks = Rank::active()->get();
        return view('frontend.profile.profile_update', compact('user', 'ranks'));
    }
    public function getProfileUpdated(Request $request){
        $this->validate($request, [
            'rank'=>'required',
            'name_bn'=>'required',
            'spouse'=>'required',
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('name_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('users/')) {
                Storage::disk('public')->makeDirectory('users/');
            }
            $makImage = Image::make($image)->resize(275, 260)->stream();
            Storage::disk('public')->put('users/' . $imageName, $makImage);
        }

        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('users/' . Auth::user()->image)) {
                Storage::disk('public')->delete('users/' . Auth::user()->image);
            }
        }

        if (empty($imageName) && !empty(Auth::user()->image)) {
            $imageName = Auth::user()->image;
        }else if(empty($imageName) && empty(Auth::user()->image)){
            $imageName = 'avatar.jpg';
        }
        $data = User::findOrFail(Auth::user()->id);
        $data->name_bn = $request->name_bn;
        $data->spouse = $request->spouse;
        $data->rank_id = $request->rank;
        $data->image = $imageName;
        $data->update();
        toast('Update Success','success');
        return redirect('user-profile');
    }
    public function getPasswordView(){
        return view('frontend.profile.password');
    }
    public function passwordUpdate(Request $request){
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_pass, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                Auth::user()->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                //notify()->success('Password Successfully Changed.', 'Success');
                toast('Password Successfully Changed','success');
                return redirect()->route('login');
            } else {
                //notify()->warning('New password cannot be the same as old password.', 'Warning');
                toast('New password cannot be the same as old password.','warning');
            }
        } else {
            //notify()->error('Current password not match.', 'Error');
            toast('Current password not match.','error');
        }
        return redirect()->back();
    }
}
