<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained('reserva_confirmadas')->onDelete('cascade'); // Referencia a la reserva confirmada
            $table->string('restaurante'); // Almacena el nombre del restaurante en lugar de una clave foránea
            $table->decimal('monto', 8, 2)->default(1.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
};