<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartcampagneToBilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bilans', function (Blueprint $table) {
            $table->date('startcampagne')->nullable()->after('campagne');
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
            $table->dropColumn('startcampagne');
        });
    }
}
