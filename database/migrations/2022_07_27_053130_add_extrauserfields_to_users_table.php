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
            $table->string('firstName')->after('mobile')->nullable();
            $table->string('lastName')->after('firstName')->nullable();
            $table->string('address1')->after('lastName')->nullable();
            $table->string('address2')->after('address1')->nullable();
            $table->string('state')->after('address2')->nullable();
            $table->string('postal_code')->after('state')->nullable();
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
            $table->dropColumn('firstName');
            $table->dropColumn('lastName');
            $table->dropColumn('address1');
            $table->dropColumn('address2');
            $table->dropColumn('state');
            $table->dropColumn('postal_code');
        });
    }
    
};
