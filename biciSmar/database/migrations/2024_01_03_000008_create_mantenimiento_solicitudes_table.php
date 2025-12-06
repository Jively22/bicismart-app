<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mantenimiento_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mantenimiento_id')->constrained('mantenimientos')->onDelete('cascade');
            $table->string('tipo_objetivo'); // bicicleta | flota
            $table->string('nombre_objetivo');
            $table->integer('cantidad')->default(1);
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimiento_solicitudes');
    }
};
