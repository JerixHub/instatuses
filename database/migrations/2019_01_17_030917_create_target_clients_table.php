<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_of_birth');
            $table->string('family_serial_number');
            $table->string('name');
            $table->float('weight');
            $table->float('length_height');
            $table->string('gender');
            $table->string('mother_name');
            $table->string('address');
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
        Schema::dropIfExists('target_clients');
    }
}
