<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObjectIdColumnToIpProductLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ip_product_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('object_id')->nullable();
            $table->text('object_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ip_product_logs', function (Blueprint $table) {
            $table->dropColumn('object_id');
            $table->dropColumn('object_type');
        });
    }
}
