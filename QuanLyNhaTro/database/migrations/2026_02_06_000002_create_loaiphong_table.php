<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('loaiphong')) {
            return;
        }

        Schema::create('loaiphong', function (Blueprint $table) {
            $table->increments('Ma_loai_phong');
            $table->string('Ten_loai_phong', 50);
            $table->decimal('Don_gia', 12, 0)->default(0);
            $table->text('Mo_ta')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loaiphong');
    }
};
