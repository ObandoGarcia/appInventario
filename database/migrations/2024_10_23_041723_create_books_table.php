<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('internal_code')
                ->nullable();
            $table->string('isbn')
                ->nullable();
            $table->string('image_url')
                ->nullable();
            $table->integer('available');
            $table->decimal('cost', total: 8, places: 2, unsigned:false);
            $table->decimal('sale_price', total: 8, places: 2, unsigned:false);
            $table->string('state')
                ->nullable();
            $table->dateTime('entry_date')
                ->nullable();
            $table->foreignId('author_id')
                ->nullable()
                ->constrained('authors')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('editorial_id')
                ->nullable()
                ->constrained('editorials')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
        Schema::dropIfExists('books');
    }
};
