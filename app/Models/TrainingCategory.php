<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function trainings()
    {
        return $this->belongsTo(Training::class, 'training_categorie_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
