<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderproteinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderprotein', function (Blueprint $table) {
            $table->increments('idorderprotein')->unsigned();
            $table->integer('stock_id');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('order_detail_id');
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
        Schema::dropIfExists('orderprotein');
    }
}
