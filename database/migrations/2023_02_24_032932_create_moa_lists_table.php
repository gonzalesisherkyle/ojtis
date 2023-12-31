<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoaListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moa_lists', function (Blueprint $table) {
            $table->id('company_id');
            $table->string('company_name');                                                                  
            $table->text('company_address');
            $table->string('company_contact_person');
            $table->string('company_contact_person_position');
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
        Schema::dropIfExists('moa_lists');
    }
}
