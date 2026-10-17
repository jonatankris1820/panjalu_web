<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menyimpan header kolom ukuran, misal: ['SIZE','S','M','L','XL','XXL','3XL','4XL']
        // Disimpan sebagai JSON karena jumlah kolom fleksibel per produk
        Schema::create('product_size_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->json('headers'); // ['SIZE','S','M','L','XL',...]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_size_headers');
    }
};
