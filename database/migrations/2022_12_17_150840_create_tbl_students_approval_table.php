<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStudentsApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_students_approval', function (Blueprint $table) {
            $table->id('approval_id');
            $table->foreignId('room_id');
            $table->foreignId('student_id');

            $table->string('approval_status')->default('pending');
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
        Schema::dropIfExists('tbl_students_approval');
    }
}
