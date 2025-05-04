<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
    public static function getGallery(){
        $areaId = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $gallery = gallery::with('area', 'club')->get();
            return $gallery;
        }else{
            $gallery = gallery::with('area', 'club')
                     ->where('area_id', $areaId)
                     ->where('club_id', $clubId)->get();
            return $gallery;
        }
    }
}
