<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes_corporativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('razon_social');
            $table->string('ruc', 15);

            $table->string('contacto_nombre');
            $table->string('contacto_email');
            $table->string('contacto_telefono');

            $table->string('tipo_evento');
            $table->date('fecha_evento');
            $table->integer('duracion_horas');
            $table->integer('cantidad_bicicletas');

            $table->text('ubicacion_evento');
            $table->text('observaciones')->nullable();

            $table->decimal('precio_total', 10, 2)->default(0);

            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes_corporativas');
    }
};
