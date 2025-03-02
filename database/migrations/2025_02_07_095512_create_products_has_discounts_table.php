<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products_has_discounts', function (Blueprint $table) {
            $table->foreignId('products_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('discounts_id')->constrained('discounts')->onDelete('cascade');
            $table->primary(['products_id', 'discounts_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('products_has_discounts');
    }
};