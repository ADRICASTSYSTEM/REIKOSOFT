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
       
        Schema::create('tipo_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('estado')->default(true);
            // ... otras columnas que necesites
            $table->timestamps();
        });
        DB::table('tipo_productos')->insert([
            [
                'nombre' => 'Producto',
                'estado' => true,
            ],
            [
                'nombre' => 'Servicio',
                'estado' => true,
            ],
            [
                'nombre' => 'Cursos',
                'estado' => true,
            ]
        ]);
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_productos');
    }
};
