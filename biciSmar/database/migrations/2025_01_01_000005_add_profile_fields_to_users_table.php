<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('cliente')->after('password');
            $table->enum('tipo_cliente', ['individual','empresa'])->default('individual')->after('role');
            $table->string('ruc', 11)->nullable()->after('tipo_cliente');
            $table->string('nombre_empresa')->nullable()->after('ruc');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role','tipo_cliente','ruc','nombre_empresa']);
        });
    }
};
