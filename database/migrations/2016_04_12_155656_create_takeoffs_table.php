<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakeoffsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('takeoffs', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');

      $table->string('name');
      $table->text('description');

      $table->integer('magento_product_id')->unsigned();
      $table->integer('magento_option_id')->unsigned();

      $table->timestamps();
    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('takeoffs');
  }
}
