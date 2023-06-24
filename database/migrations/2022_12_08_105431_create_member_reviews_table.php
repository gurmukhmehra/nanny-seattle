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
        Schema::create('member_reviews', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('reviewFromUser')->nullable();
            $table->bigInteger('reviewToUser')->nullable(); 
            $table->longText('review')->nullable();           
            $table->bigInteger('rating')->nullable();
            $table->longText('reviewstatus')->nullable();
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
        Schema::dropIfExists('member_reviews');
    }
};
