<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function leaders(){
        return $this->hasMany(sobanetry::class, 'appointment_id');
    }
public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
