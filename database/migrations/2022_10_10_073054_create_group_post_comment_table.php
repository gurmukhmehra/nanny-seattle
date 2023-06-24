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
        Schema::create('group_post_comments', function (Blueprint $table) {
            $table->id();
            $table->longText('User_IDs')->nullable();
            $table->longText('Post_IDs')->constrained();            
            $table->longText('PostComments')->nullable();
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
        Schema::dropIfExists('group_post_comments');
    }
};
