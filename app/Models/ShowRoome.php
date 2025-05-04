<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ShowRoome extends Model
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
    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
    public static function getShowroom(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $trainnings = ShowRoome::with('area')->get();
            return $trainnings;
        }else{
            $trainnings = ShowRoome::with('area')
                ->where('area_id', $area_id)->get();
            return $trainnings;
        }
    }
}
