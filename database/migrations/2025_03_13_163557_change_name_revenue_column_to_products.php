<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameRevenueColumnToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('revenue_percent_5', 'stream')->string('stream')->nullable()->change();
            $table->renameColumn('revenue_percent_4', 'band_width')->string('band_width')->nullable()->change();
            $table->renameColumn('revenue_percent_3', 'storage')->string('storage')->nullable()->change();
            $table->renameColumn('revenue_percent_2', 'ram')->string('ram')->nullable()->change();
            $table->renameColumn('revenue_percent_1', 'cpu')->string('cpu')->nullable()->change();
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
            $table->renameColumn('cpu', 'revenue_percent_1');
            $table->renameColumn('ram', 'revenue_percent_2');
            $table->renameColumn('storage', 'revenue_percent_3');
            $table->renameColumn('band_width', 'revenue_percent_4');
            $table->renameColumn('stream', 'revenue_percent_5');
        });
    }
}
