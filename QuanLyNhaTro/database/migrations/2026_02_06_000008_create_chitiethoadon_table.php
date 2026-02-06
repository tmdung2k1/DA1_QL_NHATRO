<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('chitiethoadon')) {
            return;
        }

        Schema::create('chitiethoadon', function (Blueprint $table) {
            $table->increments('Ma_cthd');
            $table->unsignedInteger('Ma_hoa_don');
            $table->unsignedInteger('Ma_dich_vu');
            $table->integer('Chi_so_cu')->default(0);
            $table->integer('Chi_so_moi')->default(0);
            $table->integer('So_luong_su_dung')->default(0);
            $table->decimal('Thanh_tien', 12, 0)->default(0);

            $table->foreign('Ma_hoa_don')
                ->references('Ma_hoa_don')
                ->on('hoadon')
                ->onDelete('cascade');
            $table->foreign('Ma_dich_vu')
                ->references('Ma_dich_vu')
                ->on('dichvu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitiethoadon');
    }
};
