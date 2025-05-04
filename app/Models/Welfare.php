<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Welfare extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }
    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function getWelfare(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        if(permission() == 'system-admin'){
            $trainnings = Welfare::with('area')->get();
            return $trainnings;
        }else{
            $trainnings = Welfare::with('area')
                ->where('club_id', $clubId)
                ->where('area_id', $area_id)->get();
            return $trainnings;
        }
    }
}
