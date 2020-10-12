<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campagnes', function (Blueprint $table) {
            $table->enum('status',['EN COURS', 'TERMINE'])->default('EN COURS')->after('intitule');
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
            $table->dropColumn('status');
        });
    }
}
