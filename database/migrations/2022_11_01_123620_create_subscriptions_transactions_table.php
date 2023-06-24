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
        Schema::create('subscriptions_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('user_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('subscription_id')->nullable();
            $table->decimal('amount', 16,2)->nullable()->default(0.00);
            $table->decimal('total', 16,2)->nullable()->default(0.00);
            $table->decimal('tax_amount', 16,2)->nullable()->default(0.00);
            $table->decimal('tax_rate', 6,3)->nullable()->default(0.000);
            $table->longText('tax_desc')->nullable();
            $table->integer('tax_compound')->nullable();
            $table->integer('tax_shipping')->nullable();
            $table->longText('tax_class')->nullable();            
            $table->bigInteger('coupon_id')->nullable();
            $table->longText('trans_num')->nullable();
            $table->longText('status')->nullable();
            $table->longText('txn_type')->nullable();
            $table->longText('gateway')->nullable();          
            $table->tinyInteger('prorated')->nullable();
            $table->bigInteger('corporate_account_id')->nullable();
            $table->bigInteger('parent_transaction_id')->nullable();
            $table->longText('response')->nullable();
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
        Schema::dropIfExists('subscriptions_transactions');
    }
};
