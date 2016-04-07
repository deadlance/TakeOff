<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingMaterial extends Model
{
    $table = 'building_materials';
    $fillable = ['name', 'slug', 'description''];
}
