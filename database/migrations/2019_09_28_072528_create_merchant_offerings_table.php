<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('merchant_offerings', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('merchant_code');
        //     $table->string('offerings');
        //     $table->integer('min_points_to_redeem');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_offerings');
    }
}
