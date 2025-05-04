<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //protected $fillable = ['name', 'name_bn', 'description'];
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public static function getRole(){
        if(permission() == 'super-admin'){
            $roles = Role::where('id', '!=', 1)->get();
        }elseif(permission() == 'area-admin'){
            $roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->get();
        }else{
            $roles = Role::all();
        }
        return $roles;
    }
}
