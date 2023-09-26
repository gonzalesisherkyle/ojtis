<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRoomStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_room_students', function (Blueprint $table) {
            $table->id('room_stud_id');
            
            $table->foreignId('room_id');
            $table->foreignId('student_id');

            $table->string('student_status');
            $table->timestamps();

            $table->foreign('room_id')->references('room_id')->on('tbl_rooms');
            $table->foreign('student_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_room_students');
    }
}
