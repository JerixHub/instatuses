<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_id');
            $table->unsignedInteger('question_id');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('m')->nullable();
            $table->integer('f')->nullable();
            $table->integer('t')->nullable();
            $table->enum('quarter', ['first','second','third','fourth']);
            $table->enum('age_range', ['under_one', 'one_four', 'five_nine', 'ten_fourteen', 'fifteen_nineteen', 'twenty_twentyfour', 'twentyfive_twentynine', 'thirty_thirtyfour', 'thirtyfive_thirtynine', 'fourty_fourtyfour', 'fourtyfive_fourtynine', 'fifty_fiftyfour', 'fiftyfive_fiftynine', 'sixty_sixtyfour', 'sixtyfive_sixtynine', 'seventy_above']);
            $table->integer('general_answer')->nullable();
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
        Schema::dropIfExists('program_question');
    }
}
