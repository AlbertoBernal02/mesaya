<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount', 10, 2)->unsigned();
            $table->foreignId('orders_id')->unique()->constrained('orders')->onDelete('cascade');
            $table->string('images', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('invoices');
    }
};