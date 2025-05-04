<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Calender extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }
    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
    public static function getCalender(){
        $area_id = Auth::user()->area_id;
        $club_id = Auth::user()->club_id;
        if(permission() == 'system-admin'){
            $club = Calender::with('club', 'area')->get();
            return $club;
        }else{
            $club = Calender::with('club', 'area')
                   ->where('club_id', $club_id)
                   ->where('area_id', $area_id)->get();
            return $club;
        }
    }
}
