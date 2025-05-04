<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChipCalender extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }
    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
//    public static function getCalender(){
//        $clubId = Auth::user()->club_id;
//        $areaId = Auth::user()->area_id;
//        $id = Auth::user()->id;
//        if($id == 1){
//            $club = Calender::with('club')->get();
//            return $club;
//        }else{
//            $club = Calender::with('club')
//                   ->where('club_id', $clubId)->get();
//            return $club;
//        }
//    }
public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
