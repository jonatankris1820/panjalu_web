<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wa_click_trackings', function (Blueprint $table) {
            $table->id();
            // float = tombol WA melayang pojok kanan
            // contact = tombol WA di halaman kontak kami  
            // product = tombol WA di halaman detail produk
            $table->enum('source', ['float', 'contact', 'product']);
            $table->string('product_slug', 255)->nullable(); // diisi jika source=product
            $table->date('clicked_date');   // tanggal klik, untuk rekap bulanan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wa_click_trackings');
    }
};
