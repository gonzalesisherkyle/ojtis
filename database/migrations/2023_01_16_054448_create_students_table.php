<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('course_id')->nullable()->default(NULL);
            $table->foreignId('adviser_id')->nullable()->default(NULL);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('student_number')->unique()->nullable()->default(NULL);
            $table->string('first_name')->nullable()->default(NULL);
            $table->string('middle_name')->nullable()->default(NULL);
            $table->string('last_name')->nullable()->default(NULL);
            $table->string('suffix')->nullable()->default(NULL);
            $table->date('date_of_birth')->nullable()->default(NULL);
            $table->string('contact_number')->nullable()->default(NULL);
            $table->text('address')->nullable()->default(NULL);
            $table->string('year_and_section')->nullable()->default(NULL);
            $table->date('email_verified_at')->nullable()->default(NULL);
            $table->text('two_factor_secret')->default(NULL)->nullable();
            $table->text('two_factor_recovery_code')->default(NULL)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('course_id')->references('course_id')->on('tbl_courses');
            $table->foreign('adviser_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
