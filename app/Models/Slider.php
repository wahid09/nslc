<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
