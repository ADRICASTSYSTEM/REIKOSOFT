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
        Schema::create('roles', function (Blueprint $table) {
            
            $table->id();

            $table->unsignedBigInteger('id_tipousuarios');
            $table->unsignedBigInteger('id_modulos');

            $table->boolean('estado')->default(true);
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('id_tipousuarios')->references('id')->on('tipo_usuarios')->onDelete('cascade');
            $table->foreign('id_modulos')->references('id')->on('modulos')->onDelete('cascade');

            // Evitar duplicados
            $table->unique(['id_tipousuarios', 'id_modulos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
