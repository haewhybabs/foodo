<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorbankdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankdetails', function (Blueprint $table) {
            $table->increments('bankdetails');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('idvendors')->on('vendors');
            $table->string('account_number');
            $table->integer('bank_code');
            $table->string('beneficiary_name');
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
        Schema::dropIfExists('bankdetails');
    }
}
