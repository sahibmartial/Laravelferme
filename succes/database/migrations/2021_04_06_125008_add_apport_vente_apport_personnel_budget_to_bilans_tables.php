<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApportVenteApportPersonnelBudgetToBilansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bilans', function (Blueprint $table) {
             $table->integer('budget')->nullable()->after('campagne')->nulle;
             $table->integer('apportVente')->nullable()->after('budget');
             $table->integer('apportPersonnel')->nullable()->after('budget');
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
             $table->dropColumn(['apportVente','budget','apportPersonnel']);
        });
    }
}
