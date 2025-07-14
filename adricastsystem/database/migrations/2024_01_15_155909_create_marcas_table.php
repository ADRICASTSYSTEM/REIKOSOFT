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
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(true);
        });

        DB::table('marcas')->insert(
          
            [
            'nombre' => 'Samsung',
            'descripcion' => 'Pertenece a la marca de Samsung',
            'estado' => true,
            ],

            [
            'nombre' => 'LG',
            'descripcion' => 'Pertenece a la marca de LG',
            'estado' => true,
            ]
        );
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};
