<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos_herramientas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')
                ->nullable()
                ->constrained('proyectos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->integer('cantidad');
            $table->integer('cantidad_devuelta')
                ->nullable();
            $table->boolean('procesado')
                ->nullable();
            $table->boolean('proyecto_activo');
            $table->foreignId('herramienta_id')
                ->nullable()
                ->constrained('herramientas')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
        Schema::dropIfExists('proyectos_herramientas');
    }
};
