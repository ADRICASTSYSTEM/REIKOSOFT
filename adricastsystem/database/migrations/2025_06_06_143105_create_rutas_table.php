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
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ejemplo: Listar usuarios
            $table->string('url');    // Ejemplo: /api/usuarios
            $table->string('descripcion');    // Ejemplo: /api/usuarios
            $table->enum('metodo', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'])->default('GET');
            
            // 👇 Aquí agregas la convención
            $table->enum('convencion', [
                'index', 'store', 'create', 'show', 'edit', 'update', 'destroy'
            ])->nullable();

            $table->boolean('estado')->default(true); // true = activo, false = inactivo
            $table->boolean('requiere_autenticacion')->default(true);

            // Clave foránea a la tabla modulos
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
