<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function slides()
    {
        return $this->belongsToMany(Slider::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function pageContent()
    {
        return $this->hasOne(pageContent::class);
    }
    public function program()
    {
        return $this->hasOne(Program::class);
    }
    public function showroome()
    {
        return $this->hasOne(ShowRoome::class);
    }
    public function leader()
    {
        return $this->hasMany(sobanetry::class);
    }
    public function training()
    {
        return $this->hasMany(Training::class);
    }
}
