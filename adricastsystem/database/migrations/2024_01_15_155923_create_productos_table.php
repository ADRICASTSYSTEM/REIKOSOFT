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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->decimal('precio', 8, 2);
            $table->integer('stock')->nullable()->default(0);
            $table->string('codigo', 50)->unique();
            $table->boolean('en_oferta')->default(false)->nullable();
            $table->decimal('precio_oferta', 8, 2)->nullable()->default(0);
            $table->boolean('publicar_web')->default(false)->nullable();
            $table->boolean('en_stock')->default(false)->nullable();
            $table->string('linkdecompra')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
