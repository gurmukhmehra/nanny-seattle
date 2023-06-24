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
        Schema::table('subscribers_plans', function (Blueprint $table) {
            $table->string('product_id')->after('user_id')->nullable();
            $table->string('coupon_id')->after('product_id')->nullable();
            $table->string('subscr_id')->after('coupon_id')->nullable();
            $table->string('price')->after('subscr_id')->nullable();
            $table->string('total')->after('price')->nullable();
            $table->string('tax_amount')->after('total')->nullable();
            $table->string('tax_rate')->after('tax_amount')->nullable();
            $table->string('tax_desc')->after('tax_rate')->nullable();
            $table->string('tax_compound')->after('tax_desc')->nullable();
            $table->string('tax_shipping')->after('tax_compound')->nullable();
            $table->string('tax_class')->after('tax_shipping')->nullable();
            $table->string('gateway')->after('tax_class')->nullable();
            $table->string('period')->after('gateway')->nullable();
            $table->string('period_type')->after('period')->nullable();
            $table->string('limit_cycles')->after('period_type')->nullable();
            $table->string('limit_cycles_num')->after('limit_cycles')->nullable();
            $table->string('limit_cycles_action')->after('limit_cycles_num')->nullable();
            $table->string('prorated_trial')->after('limit_cycles_action')->nullable();
            $table->string('trial')->after('prorated_trial')->nullable();
            $table->string('trial_days')->after('trial')->nullable();
            $table->string('trial_amount')->after('trial_days')->nullable();
            $table->string('status')->after('trial_amount')->nullable();
            $table->string('cc_last4')->after('status')->nullable();
            $table->string('cc_exp_month')->after('cc_last4')->nullable();
            $table->string('cc_exp_year')->after('cc_exp_month')->nullable();
            $table->string('token')->after('cc_exp_year')->nullable();
            $table->string('response')->after('token')->nullable();
            $table->string('limit_cycles_expires_after')->after('response')->nullable();
            $table->string('limit_cycles_expires_type')->after('limit_cycles_expires_after')->nullable();
            $table->string('trial_tax_amount')->after('limit_cycles_expires_type')->nullable();
            $table->string('trial_total')->after('trial_tax_amount')->nullable();

            $table->string('charge_id')->after('payment_intent_id')->nullable();
            $table->string('customer_id')->after('charge_id')->nullable();
            $table->string('subscription_id')->after('customer_email')->nullable();
            $table->string('subscription_item_id')->after('subscription_id')->nullable();
            $table->string('subscriptions_start_date')->after('subscription_item_id')->nullable();
            $table->string('subscriptions_end_date')->after('subscriptions_start_date')->nullable();
            $table->string('plan_product_id')->after('subscriptions_end_date')->nullable();
            $table->string('plan_price_id')->after('plan_product_id')->nullable();
            $table->string('payment_status')->after('plan_price_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers_plans', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('coupon_id');
            $table->dropColumn('subscr_id');
            $table->dropColumn('price');
            $table->dropColumn('total');
            $table->dropColumn('tax_amount');
            $table->dropColumn('tax_rate');
            $table->dropColumn('tax_desc');
            $table->dropColumn('tax_compound');
            $table->dropColumn('tax_shipping');
            $table->dropColumn('tax_class');
            $table->dropColumn('gateway');
            $table->dropColumn('period');
            $table->dropColumn('period_type');
            $table->dropColumn('limit_cycles');
            $table->dropColumn('limit_cycles_num');
            $table->dropColumn('limit_cycles_action');
            $table->dropColumn('prorated_trial');
            $table->dropColumn('trial');
            $table->dropColumn('trial_days');
            $table->dropColumn('trial_amount');
            $table->dropColumn('status');
            $table->dropColumn('cc_last4');
            $table->dropColumn('cc_exp_month');
            $table->dropColumn('cc_exp_year');
            $table->dropColumn('token');
            $table->dropColumn('response');
            $table->dropColumn('limit_cycles_expires_after');
            $table->dropColumn('limit_cycles_expires_type');
            $table->dropColumn('trial_tax_amount');
            $table->dropColumn('trial_total');
            $table->dropColumn('charge_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('subscription_id');
            $table->dropColumn('subscription_item_id');
            $table->dropColumn('subscriptions_start_date');
            $table->dropColumn('subscriptions_end_date');
            $table->dropColumn('plan_product_id');
            $table->dropColumn('plan_price_id');
            $table->dropColumn('payment_status');
        });
    }
};
