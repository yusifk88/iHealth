<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nationality_id');
            $table->string('surname');
            $table->string('opd_number')->unique();
            $table->string('other_name')->nullable();
            $table->date('dob');
            $table->integer('age');
            $table->string('sex');
            $table->string('marital_status');
            $table->string('occupation')->nullable();
            $table->string('religion')->nullable();
            $table->text('postal_address')->nullable();
            $table->text('home_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relative_address')->nullable();
            $table->string('district')->nullable();
            $table->string('location')->nullable();
            $table->string('insurance_scheme')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('insurance_id')->nullable();
            $table->date('attendance_date');
            $table->boolean('insured')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('staff');
            $table->foreign('nationality_id')->references('id')->on('nationalities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient');
    }
}
