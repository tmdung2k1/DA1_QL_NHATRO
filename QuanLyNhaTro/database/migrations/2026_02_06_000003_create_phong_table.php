<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('phong')) {
            return;
        }

        Schema::create('phong', function (Blueprint $table) {
            $table->increments('Ma_phong');
            $table->string('Ten_phong', 50);
            $table->unsignedInteger('Ma_loai_phong');
            $table->integer('Trang_thai')->default(0)->comment('0: Trống, 1: Đang thuê, 2: Bảo trì');

            $table->foreign('Ma_loai_phong')
                ->references('Ma_loai_phong')
                ->on('loaiphong')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phong');
    }
};
