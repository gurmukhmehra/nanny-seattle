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
        Schema::table('user_bios', function (Blueprint $table) {
            $table->string('parentsVehicle')->after('providerDrives')->nullable();
            $table->string('parentsNeedsLanguages')->after('providerSpeaksLanguages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_bios', function (Blueprint $table) {
            $table->dropColumn('parentsVehicle');
            $table->dropColumn('parentsNeedsLanguages');
        });
    }
};
