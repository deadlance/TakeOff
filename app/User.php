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

    public function building_materials() {
        return $this->belongsToMany('App\BuildingMaterial','building_material_users', 'user_id', 'building_material_id')->withPivot('price')->withPivot('identifying_number');
    }

}
