<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewseventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('article_title', 255);
            $table->date('article_date');
            $table->text('article_content')->nullable();
            $table->text('article_featured_img')->nullable();
            $table->string('article_type');
            $table->string('article_status');
            $table->string('article_eventdate1')->nullable();
            $table->string('article_eventdate2')->nullable();
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
        Schema::dropIfExists('news_events');
    }
}
