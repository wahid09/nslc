<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Gate;

class Training extends Model
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
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function trainingCat()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_categorie_id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
    public static function getTraining(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $trainnings = Training::with('trainingCat', 'area', 'club')->latest()->get();
            return $trainnings;
        }else{
            $trainnings = Training::with('trainingCat', 'area', 'club')
                ->where('club_id', $clubId)
                ->where('area_id', $area_id)->latest()->get();
            return $trainnings;
        }
    }
}
