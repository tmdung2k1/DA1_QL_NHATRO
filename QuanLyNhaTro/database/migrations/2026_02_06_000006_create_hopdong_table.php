<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('hopdong')) {
            return;
        }

        Schema::create('hopdong', function (Blueprint $table) {
            $table->increments('Ma_hop_dong');
            $table->unsignedInteger('Ma_phong');
            $table->unsignedInteger('Ma_khach');
            $table->date('Ngay_bat_dau');
            $table->date('Ngay_ket_thuc')->nullable();
            $table->decimal('Tien_coc', 12, 0)->default(0);
            $table->decimal('Gia_phong_thuc_te', 12, 0);
            $table->integer('Trang_thai')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('Ma_phong')->references('Ma_phong')->on('phong');
            $table->foreign('Ma_khach')->references('Ma_khach')->on('khachhang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hopdong');
    }
};
