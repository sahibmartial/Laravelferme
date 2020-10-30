<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilans', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('campagne_id');
             $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
             $table->string('campagne')->unique();
             $table->integer('totalAchats');
             $table->integer('totalVentes');
             $table->integer('quantite_achetes');
             $table->integer('quantite_perdus')->nullable();
             $table->integer('benefice')->nullable();
             $table->integer('reserve')->nullable();
             $table->integer('partenaire')->nullable();
             $table->integer('charges_salariale')->nullable();
             $table->year('annee');
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
        Schema::dropIfExists('bilans');
    }
}
