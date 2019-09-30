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
            $table->integer('merchant_code')->unique();
            $table->enum('point_type', ['0', '1']);
            $table->text('description');
            $table->string('loyalty_text');
            $table->string('loyalty_icon');
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
