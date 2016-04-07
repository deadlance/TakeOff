<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingMaterial extends Model
{
    protected $table = 'building_materials';
    protected $fillable = ['name', 'slug', 'description', 'unit_of_measure_id'];

    public function tags() {
        return $this->belongsToMany('App\Tags', 'building_material_tag', 'building_material_id', 'tag_id');
    }

    public function unit_of_measure() {
        return $this->belongsTo('App\Unit_Of_Measure');
    }

}
