<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merchant_name');
            $table->string('merchant_email');
            $table->string('merchant_uid')->nullable();
            $table->string('merchant_user_type', ['user', 'admin']);
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
        Schema::dropIfExists('merchant_user');
    }
}
