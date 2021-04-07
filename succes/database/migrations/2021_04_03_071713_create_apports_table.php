<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campagne_id');
            $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
            $table->integer('apport');
            $table->text('obs')->nullable();
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
        Schema::dropIfExists('apports');
    }
}
