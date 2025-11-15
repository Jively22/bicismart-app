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
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bicicleta_id')->constrained('bicicletas')->onDelete('cascade');
            $table->enum('tipo_alquiler', ['individual', 'corporativo']);
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->integer('cantidad_bicicletas')->default(1);
            $table->enum('estado', ['pendiente', 'activo', 'finalizado', 'cancelado'])->default('pendiente');
            $table->decimal('total', 10, 2);
            $table->string('razon_social')->nullable();
            $table->string('ruc_empresa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};