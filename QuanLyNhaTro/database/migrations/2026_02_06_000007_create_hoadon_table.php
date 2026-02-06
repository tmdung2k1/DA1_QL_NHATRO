<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('hoadon')) {
            return;
        }

        Schema::create('hoadon', function (Blueprint $table) {
            $table->increments('Ma_hoa_don');
            $table->unsignedInteger('Ma_hop_dong');
            $table->integer('Thang');
            $table->integer('Nam');
            $table->date('Ngay_lap')->nullable();
            $table->decimal('Tong_tien', 12, 0)->default(0);
            $table->integer('Trang_thai')->default(0);

            $table->foreign('Ma_hop_dong')->references('Ma_hop_dong')->on('hopdong');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
