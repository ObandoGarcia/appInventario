<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad');
            $table->string('medida')
                ->nullable();
            $table->text('descripcion')
                ->nullable();
            $table->dateTime('fecha_de_ingreso');
            $table->decimal('precio_por_unidad', total: 8, places: 2, unsigned:false);
            $table->decimal('valor_total', total:8, places:2, unsigned:false);
            $table->foreignId('marca_id')
                ->nullable()
                ->constrained('marcas')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('proveedor_id')
                ->nullable()
                ->constrained('proveedores')
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
        Schema::dropIfExists('materiales');
    }
};
