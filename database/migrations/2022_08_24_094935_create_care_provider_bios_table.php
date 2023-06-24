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
        Schema::create('care_provider_bios', function (Blueprint $table) {
            $table->id();
            $table->string('userID')->nullable();
            $table->string('TypeOfCareLooking')->nullable();
            $table->string('LookingForCareOpportunities')->nullable();
            $table->string('providerChildExperience')->nullable();
            $table->string('providerTotalExperience')->nullable();
            $table->string('minRange')->nullable();
            $table->string('maxRange')->nullable();
            $table->string('providerCareOneTime')->nullable();
            $table->longText('aboutMe')->nullable();
            $table->longText('providerSpecialNeeds')->nullable();
            $table->string('providerKonwLanguage')->nullable();
            $table->string('providerTransportSchoolActivities')->nullable();
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
        Schema::dropIfExists('care_provider_bios');
    }
};
