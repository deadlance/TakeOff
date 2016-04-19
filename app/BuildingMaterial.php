<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingMaterial extends Model
{
    protected $table = 'building_materials';
    protected $fillable = ['name', 'slug', 'description', 'unit_of_measure_id'];

    public function tags() {
        return $this->belongsToMany('App\Tags', 'building_material_tag', 'building_material_id', 'tag_id')->select(array('id', 'name'));
    }

    public function unit_of_measure() {
        return $this->belongsTo('App\Unit_Of_Measure')->select(array('id', 'name'));
    }

    public function takeoffs() {
        return $this->belongsToMany('App\Takeoffs', 'building_material_takeoff', 'building_material_id', 'takeoff_id');
    }

    public function users() {
        return $this->belongsToMany('App\BuildingMaterial','building_material_users', 'user_id', 'building_material_id')->withPivot('price')->withPivot('identifying_number');
    }

}
