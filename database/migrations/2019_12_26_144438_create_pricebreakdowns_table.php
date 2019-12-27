<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricebreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricebreakdowns', function (Blueprint $table) {
            $table->increments('idpricebreakdowns');
            $table->integer('from_region_id')->unsigned();
            $table->foreign('from_region_id')->references('idregions')->on('regions');
            $table->integer('to_region_id')->unsigned();
            $table->foreign('to_region_id')->references('idregions')->on('regions');
            $table->string('description');
            $table->integer('price');
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
        Schema::dropIfExists('pricebreakdowns');
    }
}
