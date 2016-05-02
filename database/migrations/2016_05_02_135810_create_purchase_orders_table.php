<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('status_id')->unsigned();

            $table->string('reference_number');
            $table->string('supplier_reference_number');
            $table->string('delivery_name');
            $table->string('delivery_address_1');
            $table->string('delivery_address_2');
            $table->string('delivery_address_3');
            $table->string('delivery_city');
            $table->string('delivery_state');
            $table->string('delivery_zip');
            $table->string('delivery_phone');
            $table->text('description');

            $table->timestamps();
        });

        Schema::table('purchase_orders', function(Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_orders');
    }
}
