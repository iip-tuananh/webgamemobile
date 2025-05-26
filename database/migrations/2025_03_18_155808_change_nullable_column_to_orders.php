<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableColumnToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_value', 16, 2)->nullable()->change();
            $table->decimal('total_before_discount', 16, 2)->nullable()->change();
            $table->decimal('total_after_discount', 16, 2)->nullable()->change();
            $table->decimal('aff_total_revenue', 16, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_value', 16, 2)->change();
            $table->decimal('total_before_discount', 16, 2)->change();
            $table->decimal('total_after_discount', 16, 2)->change();
            $table->decimal('aff_total_revenue', 16, 2)->change();
        });
    }
}
