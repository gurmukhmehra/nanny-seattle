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
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_title')->nullable();
            $table->string('post_title_slug')->nullable();
            //$table->string('mepr_product_price')->nullable();
            $table->unsignedDecimal('mepr_product_price', $precision = 20, $scale = 2);
            $table->string('mepr_product_period')->nullable();
            $table->string('mepr_product_limit_cycles')->nullable();
            $table->string('mepr_product_limit_cycles_num')->nullable();
            $table->string('mepr_product_limit_cycles_action')->nullable();
            $table->string('mepr_product_trial')->nullable();
            $table->string('mepr_product_trial_days')->nullable();
            //$table->string('mepr_product_trial_amount')->nullable();
            $table->unsignedDecimal('mepr_product_trial_amount', $precision = 20, $scale = 2);
            $table->string('mepr_product_trial_once')->nullable();
            $table->string('post_status')->nullable();
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
        Schema::dropIfExists('memberships');
    }
};
