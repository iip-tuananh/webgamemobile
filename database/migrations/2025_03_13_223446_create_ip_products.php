<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedTinyInteger('status')->comment('1: Đang sử dụng, 2: Đã hết hạn');
            $table->dateTime('start_date')->nullable()->comment('Ngày bắt đầu');
            $table->dateTime('end_date')->nullable()->comment('Ngày kết thúc');
            $table->string('use_time')->nullable()->comment('Thời gian sử dụng');
            $table->string('extend_time')->nullable()->comment('Số lần gia hạn');
            $table->unsignedTinyInteger('payment_status')->nullable()->comment('Trạng thái thanh toán');
            $table->string('username')->nullable()->comment('Tên đăng nhập');
            $table->string('password')->nullable()->comment('Mật khẩu');
            $table->text('note')->nullable()->comment('Ghi chú');
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
        Schema::dropIfExists('ip_products');
    }
}
