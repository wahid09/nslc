<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Notice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public static function getNotice(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $trainnings = Notice::with('area', 'club')->get();
            return $trainnings;
        }else{
            $trainnings = Notice::with('area', 'club')
                ->where('club_id', $clubId)
                ->where('area_id', $area_id)->get();
            return $trainnings;
        }
    }
}
