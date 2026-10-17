<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE products ALTER COLUMN wa_link SET DEFAULT 'https://wa.me/6281273919000'");
        }

        DB::table('products')
            ->where('wa_link', 'like', '%6289666006006%')
            ->update([
                'wa_link' => DB::raw("REPLACE(wa_link, '6289666006006', '6281273919000')"),
            ]);
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE products ALTER COLUMN wa_link SET DEFAULT 'https://wa.me/6289666006006'");
        }

        DB::table('products')
            ->where('wa_link', 'like', '%6281273919000%')
            ->update([
                'wa_link' => DB::raw("REPLACE(wa_link, '6281273919000', '6289666006006')"),
            ]);
    }
};