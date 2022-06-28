<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('preferred_date')->nullable();
            $table->string('preferrred_time')->nullable();
            $table->string('dob')->nullable();
            $table->string('tob')->nullable();
            $table->integer('service')->nullable();
            $table->integer('sub_service')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('state')->nullable();
            $table->string('country_birth')->nullable();
            $table->string('consult_service')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('appointments');
    }
}
