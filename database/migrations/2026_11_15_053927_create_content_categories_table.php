<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 20)->default('artikel'); // 'artikel' atau 'berita'
            $table->timestamps();

            $table->unique(['name', 'type']);
        });

        $now = now();
        $defaults = [
            ['name' => 'Gunung', 'type' => 'artikel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tips', 'type' => 'artikel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Budaya', 'type' => 'artikel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Destinasi', 'type' => 'artikel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pengumuman', 'type' => 'berita', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kegiatan', 'type' => 'berita', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jadwal Trip', 'type' => 'berita', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Info Gunung', 'type' => 'berita', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lainnya', 'type' => 'berita', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('content_categories')->insert($defaults);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_categories');
    }
};
