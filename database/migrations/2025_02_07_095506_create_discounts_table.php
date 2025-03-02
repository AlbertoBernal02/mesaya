<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code', 255)->unique();
            $table->decimal('percentage', 5, 2);
            $table->date('expiry_date');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('discounts');
    }
};