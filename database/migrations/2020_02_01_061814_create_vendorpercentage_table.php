<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorpercentageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorpercentage', function (Blueprint $table) {
            $table->increments('idvendorpercentage');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('idvendors')->on('vendors');
            $table->integer('percentage');
            $table->integer('minAmount');
            $table->integer('maxAmount');
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
        Schema::dropIfExists('vendorpercentage');
    }
}
