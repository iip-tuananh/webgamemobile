<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUniqueIpColumnToIpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ip_products', function (Blueprint $table) {
            $table->unique('ip')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ip_products', function (Blueprint $table) {
            $table->dropUnique('ip');
            $table->unique('ip')->change();
        });
    }
}
