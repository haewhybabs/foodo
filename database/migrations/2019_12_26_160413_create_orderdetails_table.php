<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('idorderdetails');
            $table->integer('order_summaries_id')->unsigned();
            $table->foreign('order_summaries_id')->references('idordersummaries')->on('ordersummaries');
            $table->integer('stock_details_id')->unsigned();
            $table->foreign('stock_details_id')->references('idstockdetails')->on('stockdetails');
            $table->integer('qty');
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
        Schema::dropIfExists('orderdetails');
    }
}
