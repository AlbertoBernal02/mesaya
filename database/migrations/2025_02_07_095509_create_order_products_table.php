<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->decimal('total_price', 10, 2)->unsigned();
            $table->foreignId('orders_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('products_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_products');
    }
};