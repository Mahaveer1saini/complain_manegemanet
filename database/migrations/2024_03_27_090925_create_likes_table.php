<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('complaint_id');
            $table->timestamps();
            
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            
            // Ensure each user can like a complaint only once
            $table->unique(['user_id', 'complaint_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
