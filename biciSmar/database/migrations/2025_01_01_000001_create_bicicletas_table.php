<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bicicletas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['venta', 'alquiler', 'mixto']);
            $table->decimal('precio_venta', 8, 2)->nullable();
            $table->decimal('precio_alquiler_hora', 8, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->text('descripcion')->nullable();
            $table->string('estado')->default('disponible');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bicicletas');
    }
};
