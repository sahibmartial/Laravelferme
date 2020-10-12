<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoussinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poussins', function (Blueprint $table) {
            //$table->foreignId('poussins_id')->constrained('campagnes');
            $table->id();
            $table->string('campagne')->unique();
            $table->Integer('quantite');
            $table->string('fournisseur');
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
        Schema::dropIfExists('poussins');
        //$table->dropForeign('poussins_poussins_id_foreign');
    }
}
