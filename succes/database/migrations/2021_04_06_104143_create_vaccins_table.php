<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campagne_id');
            $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
            $table->string('campagne');
            $table->date('datedevaccination');
            $table->string('intitulevaccin');
            $table->text('obs');
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
        Schema::dropIfExists('vaccins');
    }
}
