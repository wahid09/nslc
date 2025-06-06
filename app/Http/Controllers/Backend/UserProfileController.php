<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index(){
        $userInfo = DB::table('user_profiles')
                  ->join('users', 'user_profiles.user_id', '=', 'users.id')
                  ->join('roles', 'users.role_id', '=', 'roles.id')
                  ->select('user_profiles.*', 'users.name_bn', 'roles.name_bn as role_name')
                  ->where('users.id', '=', Auth::user()->id)
                  ->first();
        //return $userInfo;
        //dd($userInfo);
        return view('backend.users.user-profile', compact('userInfo'));
    }
    public function getUpdate(){
        $userInfo = DB::table('user_profiles')
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->select('user_profiles.*', 'users.id')
            ->where('users.id', '=', Auth::user()->id)
            ->first();
            //dd($userInfo);
        return view('backend.users.update-profile', compact('userInfo'));
    }
    public function getUpdateData(Request $request){
        //return $request;
        $userInfo = DB::table('user_profiles')
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->select('user_profiles.*', 'users.*')
            ->where('user_profiles.user_id', '=', Auth::user()->id)
            ->first();

        $this->validate($request, [
            'phone'=>'nullable|min:15',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender'=>'nullable'
        ]);
        $image = $request->file('image');
        //dd($image);
        $name = Str::slug(Auth::user()->name);
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('users/')) {
                Storage::disk('public')->makeDirectory('users/');
            }
            $makImage = Image::make($image)->resize(300, 300)->stream();
            Storage::disk('public')->put('users/' . $imageName, $makImage);
        }
//        if (!empty($imageName)) {
//            if (Storage::disk('public')->exists('users/' . $userInfo->image)) {
//                Storage::disk('public')->delete('users/' . $userInfo->image);
//            }
//        }

        if (empty($imageName) && !empty($userInfo->image)) {
            $imageName = $userInfo->image;
        }

        $fields = [
            'user_id'=>Auth::user()->id,
            'image'=>$imageName,
            'phone'=>$request->phone,
            'gender'=>$request->gender
        ];
        if (UserProfile::where('user_id', '=', Auth::user()->id)->exists()) {
            DB::table('user_profiles')->where('user_id', Auth::user()->id)->update($fields);
        }else{
            DB::table('user_profiles')->insert($fields);
        }
        //DB::table('user_profiles')->where('user_id', Auth::user()->id)->update($fields);
        notify()->success('Profile Updated', 'success');
        return back();
    }
    public function passwordEdit(){
        return view('backend.users.password');
    }
    public function passwordUpdate(Request $request){
        //return $request;
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_pass, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                Auth::user()->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                notify()->success('Password Successfully Changed.', 'Success');
                return redirect()->route('login');
            } else {
                notify()->warning('New password cannot be the same as old password.', 'Warning');
            }
        } else {
            notify()->error('Current password not match.', 'Error');
        }
        return redirect()->back();
    }
}
