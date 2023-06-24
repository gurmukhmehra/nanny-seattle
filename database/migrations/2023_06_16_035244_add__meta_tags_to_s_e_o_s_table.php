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
        Schema::table('s_e_o_s', function (Blueprint $table) {
            $table->longText('meta_tags')->nullable()->after('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('s_e_o_s', function (Blueprint $table) {
            $table->dropColumn('meta_tags');
        });
    }
};
