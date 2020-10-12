<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateouvertureToCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campagnes', function (Blueprint $table) {
            $table->date('start')->after('intitule');
            $table->date('end')->after('start')->nullable();
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
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
