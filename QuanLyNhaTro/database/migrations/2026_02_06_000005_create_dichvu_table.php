<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('dichvu')) {
            return;
        }

        Schema::create('dichvu', function (Blueprint $table) {
            $table->increments('Ma_dich_vu');
            $table->string('Ten_dich_vu', 50);
            $table->string('Don_vi_tinh', 20)->nullable();
            $table->decimal('Don_gia', 12, 0)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dichvu');
    }
};
