<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public static function getProduct(){
        $area_id = Auth::user()->area_id;
        $clubId = Auth::user()->club_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            $trainnings = Product::with('area')->get();
            return $trainnings;
        }else{
            $trainnings = Product::with('area')->where('area_id', $area_id)->get();
            return $trainnings;
        }
    }
}
