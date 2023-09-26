<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id('reg_id');
            $table->foreignId('adviser_id');
            $table->foreignId('course_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('year_and_section');
            $table->string('status');
            $table->timestamps();

            $table->foreign('adviser_id')->references('user_id')->on('users');
            $table->foreign('course_id')->references('course_id')->on('tbl_courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}

