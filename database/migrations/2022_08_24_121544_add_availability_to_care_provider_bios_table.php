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
        Schema::table('care_provider_bios', function (Blueprint $table) {
            $table->longText('availability')->after('providerTransportSchoolActivities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('care_provider_bios', function (Blueprint $table) {
            $table->dropColumn('availability');
        });
    }
};
