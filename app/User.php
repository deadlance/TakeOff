<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function price() {
        return $this->belongsToMany('App\BuildingMaterial','building_material_user', 'user_id', 'building_material_id')->select(array('building_material_id', 'user_id', 'price','identifying_number'));
    }

}
