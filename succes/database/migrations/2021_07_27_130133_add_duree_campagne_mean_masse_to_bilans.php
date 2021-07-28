<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDureeCampagneMeanMasseToBilans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bilans', function (Blueprint $table) {
            $table->integer('dureeCampagne')->after('annee')->nullable();
            $table->float('meanMasse')->after('dureeCampagne')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bilans', function (Blueprint $table) {
            $table->dropColumn(['dureeCampagne','meanMasse']);
        });
    }
}
