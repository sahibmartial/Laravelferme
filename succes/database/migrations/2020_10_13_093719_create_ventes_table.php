<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('campagne_id');
             $table->foreign('campagne_id')->references('id')->on('campagnes') ->onDelete('cascade');
              $table->string('campagne');
              $table->string('quantite');
              $table->string('priceUnitaire');
              $table->enum('acheteur',['Particulier', 'Grossiste'])->default('Particulier');
              $table->string('contact')->nullable();
               $table->set('events',['Party','Death','Birdthay','Autres'])->default('Autres');

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
        Schema::dropIfExists('ventes');
    }
}
