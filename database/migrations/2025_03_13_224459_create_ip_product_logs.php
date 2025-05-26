<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpProductLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_product_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ip_product_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('type')->comment('1: Đăng ký, 2: Gia hạn');
            $table->unsignedTinyInteger('payment_status')->comment('1: Đã thanh toán, 2: Chưa thanh toán');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('extend_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_product_logs');
    }
}
