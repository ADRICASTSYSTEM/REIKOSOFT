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
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->unique();
            $table->boolean('estado')->default(true);
            $table->timestamps();

        });
        DB::table('tipo_usuarios')->insert([
            [
                'descripcion' => 'Master',
                'estado' => true,
            ],
            [
                'descripcion' => 'Administrador',
                'estado' => true,
            ],
            [
                'descripcion' => 'Cliente',
                'estado' => true,
            ],
            [
                'descripcion' => 'Colaborador',
                'estado' => true,
            ],
                
            // Agrega aquí los demás campos que desees
            
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_usuarios');
    }
};
