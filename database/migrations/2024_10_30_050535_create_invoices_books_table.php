<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('invoices')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('book_id')
                ->nullable()
                ->constrained('books')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->integer('quantity');
            $table->decimal('price', total: 8, places: 2, unsigned:false);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();    
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices_items');
    }
};
