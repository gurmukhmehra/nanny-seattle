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
            $table->string('providerVehicle')->after('providerTransportSchoolActivities')->nullable();
            $table->longText('providerNeedsLanguages')->after('providerKonwLanguage')->nullable();
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
            $table->dropColumn('providerVehicle');
            $table->dropColumn('providerNeedsLanguages');
        });
    }
};
