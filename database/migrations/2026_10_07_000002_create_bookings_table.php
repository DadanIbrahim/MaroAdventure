<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // user_id bersifat nullable agar admin bisa menambah booking secara manual tanpa akun
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            
            $table->string('booking_code')->unique();
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->date('booking_date');
            $table->integer('participants')->default(1);
            $table->bigInteger('total_price')->default(0); // Harga format IDR
            
            // Status Booking dan Pembayaran
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

