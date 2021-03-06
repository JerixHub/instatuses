<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
            $table->enum('header_type', ['date','age_monthly','age_yearly','quarterly']);
            $table->boolean('with_gender')->default(false);
            $table->boolean('with_trans')->default(false);
            $table->boolean('with_target')->default(false);
            $table->boolean('with_total')->default(true);
            $table->boolean('with_icd_code')->default(false);
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
        Schema::dropIfExists('programs');
    }
}
