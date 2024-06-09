<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projectos_maquinaria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')
                ->nullable()
                ->constrained('proyectos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('maquinaria_id')
                ->nullable()
                ->constrained('maquinarias')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->boolean("estaCompletada")
                ->nullable();
            $table->foreignId('usuario_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projectos_maquinaria');
    }
};
