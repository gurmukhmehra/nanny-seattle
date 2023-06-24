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
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('siteName')->nullable();
            $table->string('siteLogo')->nullable();
            $table->string('siteFavicon')->nullable();
            $table->string('siteEmail')->nullable();
            $table->string('siteNumber')->nullable();
            $table->string('siteCopyright')->nullable();
            $table->string('facebookLink')->nullable();
            $table->string('twitterLink')->nullable();
            $table->string('youtubeLink')->nullable();
            $table->string('instagramLink')->nullable();
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
        Schema::dropIfExists('generalsettings');
    }
};
