<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDureeAlimentDemaDispoAlimentDemaUtilAlimentCroisDispoAlimentCroisUtilToCampagnes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campagnes', function (Blueprint $table) {
            $table->integer('duree')->after('status')->nullable();
            $table->integer('alimentDemaDispo')->after('duree')->nullable();
            $table->integer('alimentDemaUtil')->after('alimentDemaDispo')->nullable();
            $table->integer('alimentCroisDispo')->after('alimentDemaUtil')->nullable();
            $table->integer('alimentCroisUtil')->after('alimentCroisDispo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campagnes', function (Blueprint $table) {
            
            $table->dropColumn(['duree','alimentDemaDispo','alimentDemaUtil','alimentCroisDispo','alimentCroisUtil']);
        });
    }
}
