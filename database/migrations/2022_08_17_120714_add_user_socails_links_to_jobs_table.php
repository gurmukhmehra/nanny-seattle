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
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebookURL')->after('status')->nullable();
            $table->string('twitterURL')->after('facebookURL')->nullable();
            $table->string('instagramURL')->after('twitterURL')->nullable();
            $table->string('linkedinURL')->after('instagramURL')->nullable();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('facebookURL');
            $table->dropColumn('twitterURL');
            $table->dropColumn('instagramURL');
            $table->dropColumn('linkedinURL');
        });
    }
};
