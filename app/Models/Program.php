<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }
    public static function getProgram(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $trainnings = Program::with('area', 'club')->latest()->get();
            return $trainnings;
        }else{
            $trainnings = Program::with('area', 'club')
                ->where('club_id', $clubId)
                ->where('area_id', $area_id)->latest()->get();
            return $trainnings;
        }
    }
}
