<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $fillable = ['user_id', 'status_id', 'reference_number', 'supplier_reference_number',
                           'delivery_name', 'delivery_address_1', 'delivery_address_2', 'delivery_address_3',
                           'delivery_city', 'delivery_state', 'delivery_zip', 'delivery_phone', 'description'];


    public function building_materials() {
        return $this->belongsToMany('App\BuildingMaterial', 'building_material_purchase_order', 'purchase_order_id', 'building_material_id')->select(array('purchase_order_id','building_material_id'));
    }

    public function supplier() {
        return $this->hasOne('App\User');
    }

    public function status() {
        return $this->hasOne('App\Status');
    }

}
