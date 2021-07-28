<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateAlimentQuantiteToMasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masses', function (Blueprint $table) {
            $table->date('date')->after('id')->nullable();
            $table->string('aliment')->after('campagne')->nullable();
            $table->integer('quantite')->after('aliment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masses', function (Blueprint $table) {
            $table->dropColumn(['date','aliment','quantite']);
        });
    }
}
