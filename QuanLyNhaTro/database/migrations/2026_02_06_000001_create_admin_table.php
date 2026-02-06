<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admin')) {
            return;
        }

        Schema::create('admin', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Ten_dang_nhap', 50)->unique();
            $table->string('Mat_khau', 255);
            $table->string('Ho_ten', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
