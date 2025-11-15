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
            $table->string('marca');
            $table->string('modelo');
            $table->enum('tipo', ['montaña', 'ruta', 'urbana', 'eléctrica']);
            $table->string('tamaño');
            $table->enum('estado', ['nuevo', 'usado']);
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->decimal('precio_alquiler_hora', 8, 2)->nullable();
            $table->decimal('precio_alquiler_dia', 8, 2)->nullable();
            $table->string('imagen')->nullable();
            $table->text('descripcion');
            $table->boolean('disponible_para_venta')->default(true);
            $table->boolean('disponible_para_alquiler')->default(true);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('bicicletas');
    }
};