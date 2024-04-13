<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encargados_de_proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')
                ->nullable();
            $table->integer('telefono')
                ->nullable();
            $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados')
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
        Schema::dropIfExists('encargados_de_proyectos');
    }
};
