<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->foreignId('category_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->foreignId('uploaded_by');
            $table->date('date_uploaded');
            $table->string('adviser_approval')->default('unprocessed');
            $table->string('notary_approval')->default('unprocessed');
            $table->string('signed_approval')->default('unprocessed');
            $table->string('director_approval')->default('unprocessed');
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('tbl_file_categories');
            $table->foreign('uploaded_by')->references('user_id')->on('users');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_files');
    }
}
