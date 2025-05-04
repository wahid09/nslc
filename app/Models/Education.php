<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
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
}
