<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMoaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_moa_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->foreignId('uploaded_by');
            $table->date('date_uploaded');
            $table->string('adviser_approval')->default('unprocessed');
            $table->string('notary_approval')->default('unprocessed');
            $table->string('ojt_coordinator_approval')->default('unprocessed');

            $table->foreign('uploaded_by')->references('user_id')->on('users');
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
        Schema::dropIfExists('tbl_moa_files');
    }
}
