<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataCenterColumnToIpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ip_products', function (Blueprint $table) {
            $table->string('data_center')->after('payment_status')->nullable();
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
            $table->dropColumn('data_center');
        });
    }
}
