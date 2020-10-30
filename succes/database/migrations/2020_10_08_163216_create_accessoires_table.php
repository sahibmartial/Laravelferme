<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessoires', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('campagne_id');
             $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
            $table->string('campagne');
            $table->string('libelle');
            $table->integer('quantite');
            $table->integer('priceUnitaire');
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
        Schema::dropIfExists('accessoires');
    }
}
