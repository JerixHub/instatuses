<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_question_id');
            $table->integer('m')->nullable();
            $table->integer('f')->nullable();
            $table->integer('t')->nullable();
            $table->integer('target')->nullable();
            $table->enum('quarter', ['first','second','third','fourth'])->nullable();
            $table->enum('age_range', ['under_one', 'one_four', 'five_nine', 'ten_fourteen', 'fifteen_nineteen', 'twenty_twentyfour', 'twentyfive_twentynine', 'thirty_thirtyfour', 'thirtyfive_thirtynine', 'fourty_fourtyfour', 'fourtyfive_fourtynine', 'fifty_fiftyfour', 'fiftyfive_fiftynine', 'sixty_sixtyfour', 'sixtyfive_sixtynine', 'seventy_above'])->nullable();
            $table->integer('general_answer')->nullable();

            $table->foreign('program_question_id')->references('id')->on('program_question')->onDelete('cascade');
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
        Schema::dropIfExists('answers');
    }
}
