<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewFalconGazette extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('falcon_gazette', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gaz_title', 255);
            $table->date('gaz_date');
            $table->text('gaz_pdf_filename');
            $table->string('gaz_status', 45);
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
        Schema::dropIfExists('falcon_gazette');
    }
}
