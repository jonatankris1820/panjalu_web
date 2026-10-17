<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('harga_mulai', 50);
            $table->string('spesifikasi', 150)->nullable();
            $table->string('wa_link', 255)->default('https://wa.me/6281273919000');
            $table->string('cover_image', 500);
            $table->text('deskripsi_singkat')->nullable();
            $table->text('detail_deskripsi')->nullable();
            $table->text('detail_harga_catatan_judul')->nullable();
            $table->string('ukuran_toleransi', 255)->nullable();
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
