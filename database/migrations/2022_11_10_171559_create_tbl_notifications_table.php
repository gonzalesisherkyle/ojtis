<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->string('message');
            $table->foreignId('sent_to');
            $table->foreignId('sent_by');
            $table->timestamps();

            $table->foreign('sent_to')->references('user_id')->on('users');
            $table->foreign('sent_by')->references('user_id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_notifications');
    }
}
