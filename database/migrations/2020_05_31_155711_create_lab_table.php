<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_id');
            $table->text('tests');
            $table->text('results');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('staff');
            $table->foreign('opd_id')->references('id')->on('opd');

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
        Schema::dropIfExists('lab');
    }
}
