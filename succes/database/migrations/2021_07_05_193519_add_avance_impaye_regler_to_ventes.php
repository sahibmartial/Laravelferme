<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvanceImpayeReglerToVentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->float('avance')->nullable()->after('events');
            $table->float('impaye')->nullable()->after('avance');
            $table->string('regler')->nullable()->after('impaye');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropColumn('avance');
            $table->dropColumn('impaye');
            $table->dropColumn('regler');
        });
        
    }
}
