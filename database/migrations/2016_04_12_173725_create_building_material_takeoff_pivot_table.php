<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingMaterialTakeoffPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_material_takeoff', function (Blueprint $table) {
            $table->integer('building_material_id')->unsigned()->index();
            $table->foreign('building_material_id','bm_to_id')->references('id')->on('building_materials')->onDelete('cascade');
            $table->integer('takeoff_id')->unsigned()->index();
            $table->foreign('takeoff_id','to_bm_id')->references('id')->on('takeoffs')->onDelete('cascade');
            $table->primary(['building_material_id', 'takeoff_id'], 'bm_to_id_primary');

            $table->integer('qty')->unsigned();
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_material_takeoff');
    }
}
