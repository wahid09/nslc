<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Area extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programs()
    {
        return $this->hasMany(Program::class, 'area_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function leaders()
    {
        return $this->hasMany(sobanetry::class, 'area_id');
    }
    public function galleries()
    {
        return $this->hasMany(gallery::class, 'area_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'area_id');
    }
    public function showroomes()
    {
        return $this->hasMany(ShowRoome::class, 'area_id');
    }
    public function trainings()
    {
        return $this->hasMany(Training::class, 'area_id');
    }
    public function education()
    {
        return $this->hasMany(Education::class, 'area_id');
    }
    public static function getArea(){
        $area_id = Auth::user()->area_id;
        $id = Auth::user()->id;
        if(permission() == 'system-admin'){
            return $area = DB::table('areas')->get();
        }else{
            return $area = DB::table('areas')->where('id', $area_id)->get();
        }
    }
}
