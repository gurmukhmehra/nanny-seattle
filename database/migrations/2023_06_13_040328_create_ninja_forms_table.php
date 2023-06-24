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
        Schema::create('ninja_forms', function (Blueprint $table) {
            $table->id();
            $table->string('formGroupID')->nullable();
            $table->string('ninja_form_name')->nullable();
            $table->string('userID')->nullable();
            $table->string('YouNeedChildCare')->nullable();
            $table->string('HowManyChildren')->nullable();
            $table->string('AgeChildNeedCare')->nullable();
            $table->string('NeedCareSick')->nullable();
            $table->string('NeighborHoodYouLive')->nullable();
            $table->string('DesiredStartTime')->nullable();
            $table->string('DesiredEndTime')->nullable();
            $table->string('PayRate')->nullable();
            $table->string('AdditionalInformation')->nullable();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('emails')->nullable();
            $table->string('PhoneNumber')->nullable();
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
        Schema::dropIfExists('ninja_forms');
    }
};
