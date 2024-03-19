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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_uni_id')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 10)->nullable();
            $table->tinyInteger('age')->nullable();
            $table->string('staff_img')->nullable();
            $table->string('birth_place')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
};
