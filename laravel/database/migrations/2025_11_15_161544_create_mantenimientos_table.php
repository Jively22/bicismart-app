<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bicicleta_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['preventivo', 'correctivo', 'revision', 'urgente']);
            $table->text('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin_prevista')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->decimal('costo_estimado', 8, 2)->nullable();
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado', 'cancelado'])->default('pendiente');
            $table->string('tecnico_responsable')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
};