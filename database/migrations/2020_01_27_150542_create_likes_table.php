<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorslikes', function (Blueprint $table) {
            $table->increments('idvendorlikes');
            $table->integer('vendor_review_id')->unsigned();
            $table->foreign('vendor_review_id')->references('idvendorsreviews')->on('vendorsreviews');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('vendorslikes');
    }
}
