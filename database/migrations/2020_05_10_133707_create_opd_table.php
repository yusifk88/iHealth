<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('cc_code')->nullable();
            $table->double('temperature');
            $table->string('bp')->nullable();
            $table->double('height')->nullable();
            $table->double('weight');
            $table->string('weight_remarks')->nullable();
            $table->double('pulse');
            $table->double('respiration')->nullable();
            $table->string('temperature_remarks')->nullable();
            $table->string('bp_remarks')->nullable();
            $table->string('height_remarks')->nullable();
            $table->string('pulse_remarks')->nullable();
            $table->string('respiration_remarks')->nullable();
            $table->date('entry_date');
            $table->foreign('user_id')->references('id')->on('staff');
            $table->foreign('patient_id')->references('id')->on('patient');
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
        Schema::dropIfExists('opd');
    }
}
