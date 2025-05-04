<?php

namespace App\Models;

use App\Services\SMSService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Cache;
use Illuminate\Support\Facades\Http;
use Mail;
use App\Mail\SendCodeMail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function profile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }

    public static function getUser()
    {
        $areaId = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        if (permission() == 'super-admin') {
            $roles = User::where('club_id', '==', $clubId)->get();
        } elseif (permission() == 'area-admin') {
            $roles = User::where('area_id', '==', $areaId)->where('club_id', '==', $clubId)->get();
        } else {
            $roles = User::all();
        }
        return $roles;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );

        try {

            $details = [
                'title' => 'Mail from slc.army.mil.bd',
                'code' => $code
            ];

            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));

        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }
    public function membershipLoginWithoutCode(){
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );
    }

    public function loginWithSmsOtp(){
        $code = rand(1000, 9999);
        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );
        $phone = User::select('phone')->where('id', auth()->user()->id)->first();
        $message = 'Your Login Code is: '.$code;
        $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
            'username' => 'ITDAHQAdmin_3753',
            'password' => 'ITdte@2020',
            'apicode' => '1',
            'countrycode' => '880',
            'cli' => 'IT DTE',
            'msisdn' => $phone->phone,
            'messagetype' => '1',
            'message' => $message,
            'messageid' => '0'
        ]);
    }
}
