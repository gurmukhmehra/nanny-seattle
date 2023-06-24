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
            $table->string('providerCareOneTime')->nullable(); 
            $table->string('providerChildExperience')->nullable();
            $table->longText('providerTransportSchoolActivities')->nullable();
            $table->longText('availability')->nullable();
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
            $table->dropColumn('providerCareOneTime');
            $table->dropColumn('providerChildExperience');
            $table->dropColumn('providerTransportSchoolActivities');
            $table->dropColumn('availability');
        });
    }
};
