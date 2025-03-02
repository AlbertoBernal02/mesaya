<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shopping_carts_has_products', function (Blueprint $table) {
            $table->foreignId('shopping_carts_id')->constrained('shopping_carts')->onDelete('cascade');
            $table->foreignId('products_id')->constrained('products')->onDelete('cascade');
            $table->primary(['shopping_carts_id', 'products_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('shopping_carts_has_products');
    }
};