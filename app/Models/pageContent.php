<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pageContent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['image' => 'array'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
