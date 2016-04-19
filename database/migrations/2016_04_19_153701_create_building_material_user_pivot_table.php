<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingMaterialUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_material_user', function (Blueprint $table) {
            $table->integer('building_material_id')->unsigned()->index();
            $table->foreign('building_material_id')->references('id')->on('building_materials')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['building_material_id', 'user_id']);

            $table->string('identifying_number');
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
        Schema::drop('building_material_user');
    }
}
