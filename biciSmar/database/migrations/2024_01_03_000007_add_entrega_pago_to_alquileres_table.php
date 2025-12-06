<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alquileres', function (Blueprint $table) {
            $table->integer('cantidad')->default(1);
            $table->string('modo_entrega')->default('recoger'); // recoger o entregar
            $table->string('direccion_entrega')->nullable();
            $table->string('metodo_pago')->default('efectivo'); // efectivo, tarjeta, yape_plin
        });
    }

    public function down(): void
    {
        Schema::table('alquileres', function (Blueprint $table) {
            $table->dropColumn(['cantidad', 'modo_entrega', 'direccion_entrega', 'metodo_pago']);
        });
    }
};
