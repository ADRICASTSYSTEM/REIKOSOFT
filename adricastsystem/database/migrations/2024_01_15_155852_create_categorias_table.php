<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(true);
        });
        DB::table('categorias')->insert(
            [
                
            'nombre' => 'Celulares',
            'descripcion' => 'Pertenece a la categoria de celulares y smartphones',
            'estado' => true,
            ],

            [
            'nombre' => 'Televisores',
            'descripcion' => 'Pertenece a la categoria de televisores',
            'estado' => true,
            ]

        
    );

    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
