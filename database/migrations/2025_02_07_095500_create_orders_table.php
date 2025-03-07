<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', 10, 2)->unsigned();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('order_date')->default(now()); // ✅ Asegurar que esta línea esté aquí
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};