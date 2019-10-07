<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merchant_name');
            $table->string('merchant_image');
            $table->integer('merchant_code')->unique();
            $table->string('point_type');
            $table->text('description');
            $table->string('loyalty_text');
            $table->string('loyalty_icon')->nullable();
            $table->string('offerings');
            $table->integer('min_points_to_redeem');
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
        Schema::dropIfExists('merchant_data');
    }
}
