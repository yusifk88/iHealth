<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescrpitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('opd_id');
            $table->unsignedBigInteger('consulting_id');
            $table->unsignedBigInteger('drug_id');
            $table->integer('quantity')->default(1);
            $table->string('dosage')->nullable();
            $table->boolean('dispensed')->default(false);
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('prescrpition');
    }
}
