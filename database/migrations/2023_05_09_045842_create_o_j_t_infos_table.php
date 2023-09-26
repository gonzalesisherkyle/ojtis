<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOJTInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_j_t_infos', function (Blueprint $table) {
            $table->id('info_id');
            $table->foreignId('student_id');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('nature_of_bus');
            $table->string('nature_of_link');
            $table->string('level');
            $table->date('start_date');
            $table->date('finish_date');
            $table->string('report_time');
            $table->string('contact_name');
            $table->string('contact_position');
            $table->string('contact_number');
            $table->timestamps();

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
        Schema::dropIfExists('o_j_t_infos');
    }
}
