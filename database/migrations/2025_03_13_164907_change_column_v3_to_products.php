<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnV3ToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('revenue_percent_5', 'stream')->default(null)->change();
            $table->renameColumn('revenue_percent_4', 'band_width')->default(null)->change();
            $table->renameColumn('revenue_percent_3', 'storage')->default(null)->change();
            $table->renameColumn('revenue_percent_2', 'ram')->default(null)->change();
            $table->renameColumn('revenue_percent_1', 'cpu')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stream');
            $table->dropColumn('band_width');
            $table->dropColumn('storage');
            $table->dropColumn('ram');
            $table->dropColumn('cpu');
        });
    }
}
