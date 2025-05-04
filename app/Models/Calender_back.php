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
    public static function getCalender(){
$clubId=Auth::user()->club_id;
        if(permission() == 'system-admin'){
            $club = Calender::with('club')->get();
            return $club;
        }else{
            $club = Calender::with('club')
                   ->where('club_id', $clubId)->get();
            return $club;
        }
    }
}
