<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersummaries', function (Blueprint $table) {
            $table->increments('idordersummaries');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('idvendors')->on('vendors');
            $table->integer('bikeman_id')->nullable()->unsigned();
            $table->foreign('bikeman_id')->references('idbikemen')->on('bikemen');
            $table->integer('from_region_id')->unsigned();
            $table->foreign('from_region_id')->references('idregions')->on('regions');
            $table->integer('to_region_id')->unsigned();
            $table->foreign('to_region_id')->references('idregions')->on('regions');
            $table->integer('status');
            $table->integer('price');
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
        Schema::dropIfExists('ordersummaries');
    }
}
