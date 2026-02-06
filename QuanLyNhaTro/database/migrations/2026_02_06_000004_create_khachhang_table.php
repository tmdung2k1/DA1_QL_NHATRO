<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('khachhang')) {
            return;
        }

        Schema::create('khachhang', function (Blueprint $table) {
            $table->increments('Ma_khach');
            $table->string('Ho_ten', 50);
            $table->string('Cccd', 20)->unique();
            $table->string('Sdt', 15)->nullable();
            $table->string('Que_quan', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->date('Ngay_vao')->nullable();
            $table->integer('Trang_thai')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khachhang');
    }
};
