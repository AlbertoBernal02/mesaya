<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->decimal('total_price', 10, 2)->unsigned();
            $table->foreignId('categories_id')->constrained('categories')->onDelete('cascade');
            $table->string('image', 255);
            $table->string('ubication');
            $table->integer('capacity');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('visible')->default(true); // Nuevo campo para ocultar productos
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};