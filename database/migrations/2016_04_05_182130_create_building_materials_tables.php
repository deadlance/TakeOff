<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingMaterialsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('unit_of_measure', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');

            $table->timestamps();
        });

        Schema::create('building_material_categories', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');

            $table->timestamps();
        });

        Schema::create('building_materials', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('unit_of_measure_id')->unsigned();
            $table->integer('building_material_categories_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('building_materials', function($table) {
            $table->foreign('unit_of_measure_id')->references('id')->on('unit_of_measure')->onDelete('cascade');
            $table->foreign('building_material_categories_id')->references('id')->on('building_material_categories')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_materials');
        Schema::drop('building_material_categories');
        Schema::drop('unit_of_measure');
    }
}
