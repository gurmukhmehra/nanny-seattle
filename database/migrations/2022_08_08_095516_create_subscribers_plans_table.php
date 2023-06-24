<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers_plans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('payment_intent_id')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('buy_data_time')->nullable();
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
        Schema::dropIfExists('subscribers_plans');
    }
};
