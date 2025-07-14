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
      

         Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('estado')->default(true);
            $table->string('icono', 50)->nullable(); // <- nuevo campo aquí
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};
