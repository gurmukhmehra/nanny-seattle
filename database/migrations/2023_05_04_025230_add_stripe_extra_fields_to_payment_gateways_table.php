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
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->longText('test_endpoint_secret')->nullable()->after('StripePublishablekey');
            $table->longText('live_StripeSecretkey')->nullable()->after('test_endpoint_secret');
            $table->longText('live_StripePublishablekey')->nullable()->after('live_StripeSecretkey');
            $table->longText('live_endpoint_secret')->nullable()->after('live_StripePublishablekey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn('test_endpoint_secret');
            $table->dropColumn('live_StripeSecretkey');
            $table->dropColumn('live_StripePublishablekey');
            $table->dropColumn('live_endpoint_secret');
        });
    }
};
