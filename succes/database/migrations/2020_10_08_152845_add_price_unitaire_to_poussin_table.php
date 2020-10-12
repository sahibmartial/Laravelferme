<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceUnitaireToPoussinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poussins', function (Blueprint $table) {
            $table->Integer('priceUnitaire')->after('quantite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poussins', function (Blueprint $table) {
            $table->dropColumn('priceUnitaire');
        });
    }
}
