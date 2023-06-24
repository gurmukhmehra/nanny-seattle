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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('jobTitle')->nullable();
            $table->string('jobSlug')->nullable();
            $table->string('jobLocatin')->nullable();
            $table->string('IdealStartDate')->nullable();
            $table->longText('jobSchedule')->nullable();
            $table->longText('children')->nullable();
            $table->longText('compensation')->nullable();
            $table->longText('jobExperience')->nullable();
            $table->longText('AboutFamily')->nullable();
            $table->longText('jobDescription')->nullable();
            $table->longText('Qualification_Requirement')->nullable();
            $table->longText('status')->nullable();
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
        Schema::dropIfExists('jobs');
    }
};
