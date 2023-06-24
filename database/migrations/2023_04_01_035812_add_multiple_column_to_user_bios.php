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
            $table->longText('currently_seeking_provider_work')->nullable()->after('userType');
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
            $table->dropColumn('currently_seeking_provider_work');
        });
    }
};
