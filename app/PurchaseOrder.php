<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $fillable = ['user_id', 'status_id', 'reference_number', 'supplier_reference_number',
                           'delivery_name', 'delivery_address_1', 'delivery_address_2', 'delivery_address_3',
                           'delivery_city', 'delivery_state', 'delivery_zip', 'delivery_phone', 'description'];


    public function supplier() {
        return $this->hasOne('App\User');
    }

    public function status() {
        return $this->hasOne('App\Status');
    }

}
