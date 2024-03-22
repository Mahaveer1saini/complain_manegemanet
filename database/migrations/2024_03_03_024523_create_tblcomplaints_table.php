<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tblcomplaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('category');
            $table->string('subcategory');
            $table->string('complaint_type');
            $table->string('state');
            $table->string('noc');
            $table->text('complaint_details');
            $table->text('complaint_file');
            $table->text('city');
            $table->string('tehsil')->nullable();
            $table->string('village')->nullable();
            $table->string('word')->nullable();
            $table->integer('status')->default(0)->index('status');
            $table->string('country')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tblcomplaints');
    }
};
