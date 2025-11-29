<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo_cliente')->nullable()->after('email');
            $table->string('ruc')->nullable()->after('tipo_cliente');
            $table->string('nombre_empresa')->nullable()->after('ruc');
            $table->boolean('is_admin')->default(false)->after('nombre_empresa');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tipo_cliente', 'ruc', 'nombre_empresa', 'is_admin']);
        });
    }
};
