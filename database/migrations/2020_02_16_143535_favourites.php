<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Favourites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->increments('idfavourites');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('idcustomers')->on('customers');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('idvendors')->on('vendors');
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
        //
    }
}
