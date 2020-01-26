<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('idaddress');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('idcustomers')->on('customers');
            $table->integer('region_id');
            $table->string('complete_address');
            $table->string('delivery_instruction')->nullable();
            $table->integer('active')->nullable();
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
        Schema::dropIfExists('adddress');
    }
}
