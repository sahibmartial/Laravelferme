<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertes', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('campagne_id');
             $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
          // $table->integer('campagne_id');
            $table->string('campagne');
            $table->integer('quantite');
            $table->text('cause');
            $table->text('obs')->nullable();
            $table->integer('duredevie');//cacluler a partir de la date ceation campagne
            $table->string('year');//calculer a partir de la date start campagne
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
        Schema::dropIfExists('pertes');
    }
}
