<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rooms', function (Blueprint $table) {
            $table->id('room_id');

            $table->foreignId('adviser_id');
            $table->foreignId('course_id');

            $table->string('room_name');
            $table->string('room_status')->default('open');

            $table->foreign('adviser_id')->references('user_id')->on('users');
            $table->foreign('course_id')->references('course_id')->on('tbl_courses');
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
        Schema::dropIfExists('tbl_rooms');
    }
}
