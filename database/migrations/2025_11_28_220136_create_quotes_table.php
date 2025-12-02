<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_document')->nullable(); // DNI/RUC
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_company')->nullable();
            $table->decimal('exchange_rate', 10, 4); // Tipo de cambio
            $table->decimal('subtotal_usd', 10, 2)->default(0);
            $table->decimal('subtotal_pen', 10, 2)->default(0);
            $table->decimal('igv_usd', 10, 2)->default(0); // 18%
            $table->decimal('igv_pen', 10, 2)->default(0);
            $table->decimal('total_usd', 10, 2)->default(0);
            $table->decimal('total_pen', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
