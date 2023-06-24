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
        Schema::create('user_bios', function (Blueprint $table) {
            $table->id();
            $table->string('userID')->nullable();
            $table->string('userType')->nullable();
            $table->string('live_in')->nullable();
            $table->longText('TypeOfCareLooking')->nullable();
            $table->longText('CareOpportunities')->nullable();
            $table->string('minRange')->nullable();
            $table->string('maxRange')->nullable();
            $table->longText('aboutMyfamily')->nullable();
            $table->string('numnerOfchild')->nullable();
            $table->string('childAge')->nullable();
            $table->string('providerExperience')->nullable();
            $table->longText('ChildSpecialNeeds')->nullable();
            $table->string('providerSpeaksLanguages')->nullable();
            $table->string('providerDrives')->nullable();
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
        Schema::dropIfExists('user_bios');
    }
};
