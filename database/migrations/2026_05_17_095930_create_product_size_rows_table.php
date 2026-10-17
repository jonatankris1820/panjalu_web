<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Setiap baris ukuran, misal: label=P, nilai=[68,71,74,76,78,80,82]
        Schema::create('product_size_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('label', 10);  // P, L, PL
            $table->json('nilai');         // [68, 71, 74, 76, ...]
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_size_rows');
    }
};
