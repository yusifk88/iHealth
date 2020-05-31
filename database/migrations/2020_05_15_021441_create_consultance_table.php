<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultance', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('opd_id');
            $table->text('complain')->nullable();
            $table->text('complain_history')->nullable();
            $table->text('drug_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('questions')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('psychological_history')->nullable();
            $table->text('gynecological_history')->nullable();
            $table->text('system_review')->nullable();
            $table->text('diagnosis')->nullable();
            $table->boolean('detained')->default(false);
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->text('other_drugs')->nullable();

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
        Schema::dropIfExists('consultance');
    }
}
