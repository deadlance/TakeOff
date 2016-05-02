<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_line_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('purchase_order_id')->unsigned();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->integer('line_item_id');
            $table->foreign('line_item_id')->references('id')->on('building_materials')->onDelete('cascade');

            $table->text('description');
            $table->decimal('price', 10, 4);
            $table->integer('quantity')->unsigned();
            $table->decimal('line_item_total', 10, 4);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_order_line_items');
    }
}
