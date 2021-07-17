<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrigineApportToApportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apports', function (Blueprint $table) {
            $table->string('origine_apport')->nullable()->after('apport');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apports', function (Blueprint $table) {
            $table->dropColumn('origine_apport');
        });
    }
}
