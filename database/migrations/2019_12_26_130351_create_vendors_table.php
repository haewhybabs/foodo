<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('idvendors');
            $table->string('manager_name');
            $table->string('store_name');
            $table->string('address');
            $table->string('logo');
            $table->string('phone_number');
            $table->integer('status');
            $table->string('description');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('idcategories')->on('categories');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('idregions')->on('regions');
            $table->time('open_at');
            $table->time('close_at');
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
        Schema::dropIfExists('vendors');
    }
}
