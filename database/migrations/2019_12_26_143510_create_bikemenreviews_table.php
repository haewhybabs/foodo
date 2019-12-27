<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikemenreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikemenreviews', function (Blueprint $table) {
            $table->increments('idbikemenreviews');
            $table->integer('bike_man_id')->unsigned();
            $table->foreign('bike_man_id')->references('idbikemen')->on('bikemen');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('idcustomers')->on('customers');
            $table->integer('rating');
            $table->string('review');
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
        Schema::dropIfExists('bikemenreviews');
    }
}
