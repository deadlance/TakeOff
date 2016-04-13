<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Takeoff extends Model
{
  protected $table = 'takeoffs';
  protected $fillable = ['name','description', 'magento_product_id', 'magento_option_id'];

    public function building_materials() {
        return $this->belongsToMany('App\BuildingMaterial','building_material_takeoff', 'takeoff_id', 'building_material_id')->withPivot('qty')->withPivot('notes');
    }


}
