<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_announcements', function (Blueprint $table) {
            $table->id('announcement_id');
            
            $table->foreignId('room_id');
            $table->foreignId('from');
            $table->foreignId('to')->nullable()->default(NULL);
            
            $table->string('title');
            $table->string('body');
            $table->string('file_name')->nullable()->default(NULL);
            $table->string('file_path')->nullable()->default(NULL);

            $table->timestamps();

            $table->foreign('room_id')->references('room_id')->on('tbl_rooms');
            $table->foreign('from')->references('user_id')->on('users');
            $table->foreign('to')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_announcements');
    }
}
