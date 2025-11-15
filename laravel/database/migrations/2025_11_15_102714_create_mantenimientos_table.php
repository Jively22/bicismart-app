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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bicicleta_id')->constrained('bicicletas')->onDelete('cascade');
            $table->enum('tipo', ['preventivo', 'correctivo', 'revision']);
            $table->text('descripcion');
            $table->date('fecha_mantenimiento');
            $table->decimal('costo', 10, 2);
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');
            $table->string('tecnico_responsable')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Índices para mejorar el rendimiento de las consultas
            $table->index('bicicleta_id');
            $table->index('estado');
            $table->index('tipo');
            $table->index('fecha_mantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};