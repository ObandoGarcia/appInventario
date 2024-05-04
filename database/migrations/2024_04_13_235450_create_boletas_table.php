<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')
                ->nullable()
                ->constrained('conductores')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->dateTime('fecha');
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
            $table->integer('cantidad');
            $table->text('descripcion')
                ->nullable();
            $table->string('recibido_por');
            $table->string('entregado_por');
            $table->integer('numero_de_impresiones');
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
        Schema::dropIfExists('boletas');
    }
};
