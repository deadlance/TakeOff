<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingmaterialPurchaseorderPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_material_purchase_order', function (Blueprint $table) {
            $table->integer('building_material_id')->unsigned()->index();
            $table->foreign('building_material_id')->references('id')->on('building_materials')->onDelete('cascade');
            $table->integer('purchase_order_id')->unsigned()->index();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->primary(['building_material_id', 'purchase_order_id'], 'bo_po_identifier');

            $table->text('description');
            $table->integer('quantity');
            $table->decimal('price', 10, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_material_purchase_order');
    }
}
