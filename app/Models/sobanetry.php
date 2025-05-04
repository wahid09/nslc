<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class sobanetry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function areaName()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function appointment(){
        return$this->belongsTo(Appointment::class, 'appointment_id');
    }
    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }
    public static function getLeaders(){
        $areaId = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $leader = sobanetry::with('areaName', 'club')->get();
            return $leader;
        }else{
            $leader = sobanetry::with('areaName', 'club')
                ->where('area_id', $areaId)
                ->where('club_id', $clubId)->get();
            return $leader;
        }
    }
}
