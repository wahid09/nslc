<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
public function users()
    {
        return $this->hasMany(User::class);
    }
}
