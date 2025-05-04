<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Club extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany(User::class, 'club_id');
    }
    public function galleries(){
        return $this->hasMany(gallery::class, 'club_id');
    }
    public function trainings(){
        return $this->hasMany(Training::class, 'club_id');
    }
    public function leaders(){
        return $this->hasMany(sobanetry::class, 'club_id');
    }
    public function calenders(){
        return $this->hasMany(Calender::class, 'club_id');
    }
    public function programes(){
        return $this->hasMany(Program::class, 'club_id');
    }
    public function policies(){
        return $this->hasMany(Policy::class, 'club_id');
    }
    public function publications(){
        return $this->hasMany(Prokasone::class, 'club_id');
    }
public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function educations(){
        return $this->hasMany(Education::class, 'club_id');
    }
    public static function getClubs(){
        $club_id = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            return $clubs = DB::table('clubs')->get();
        }else{
            return $clubs = DB::table('clubs')->where('id', $club_id)->get();
        }
    }
}
