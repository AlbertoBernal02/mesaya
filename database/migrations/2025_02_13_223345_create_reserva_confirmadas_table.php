<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reserva_confirmadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('restaurante')->default('Lumiere');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('num_comensales');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserva_confirmadas');
    }
};