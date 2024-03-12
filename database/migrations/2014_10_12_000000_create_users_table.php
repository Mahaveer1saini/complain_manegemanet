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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->index('role_id_2');
            $table->string('name')->nullable()->index('name');
            $table->string('email')->nullable()->index('email');
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->integer('status')->default(0)->index('status');
            $table->bigInteger('contact')->nullable();
            $table->text('address')->nullable();
            $table->string('State')->nullable();
            $table->string('country')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
           // Assuming status can be NULL
             // Adds created_at and updated_at columns
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
