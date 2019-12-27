<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockdetails', function (Blueprint $table) {
            $table->increments('idstockdetails');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('idvendors')->on('vendors');
            $table->string('description');
            $table->string('name');
            $table->string('image');
            $table->integer('stockprice');
            $table->integer('stock_category_id')->unsigned();
            $table->foreign('stock_category_id')->references('idstockcategories')->on('stockcategories');
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
        Schema::dropIfExists('stockdetails');
    }
}
