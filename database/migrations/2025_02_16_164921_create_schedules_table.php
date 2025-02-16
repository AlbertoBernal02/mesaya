<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->json('unavailable_hours')->nullable(); // Guardará las horas no disponibles
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('schedules');
    }
};
