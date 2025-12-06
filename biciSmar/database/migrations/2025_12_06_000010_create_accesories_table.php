<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accesories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('categoria')->nullable(); // parte, repuesto, merch
            $table->string('tag')->nullable(); // oficial, asociado
            $table->decimal('precio', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->text('descripcion')->nullable();
            $table->string('foto')->nullable();
            $table->string('estado')->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accesories');
    }
};
