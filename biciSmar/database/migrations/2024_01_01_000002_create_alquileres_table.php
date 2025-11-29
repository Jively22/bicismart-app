<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('bicicleta_id')->constrained('bicicletas')->onDelete('cascade');
            $table->string('tipo_cliente')->default('individual'); // individual o empresa
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->decimal('precio_total', 10, 2);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};
