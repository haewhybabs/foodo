<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikemen', function (Blueprint $table) {
            $table->increments('idbikemen');
            $table->string('name');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('idregions')->on('regions');
            $table->string('phone_number');
            $table->integer('status');
            $table->string('home_address');
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
        Schema::dropIfExists('bikemen');
    }
}
