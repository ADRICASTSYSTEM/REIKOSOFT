<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('username');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('direccion')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('foto')->nullable();

            $table->unsignedBigInteger('tipo_usuario_id')->nullable();    
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios')->onDelete('cascade');

        });
        DB::table('users')->insert([
            [   
                'name' => 'Admin',
                'username' => 'Admin',
                'nombres' => 'Administrador',
                'apellidos' => 'Administrador',
                'telefono' => '123456789',
                'direccion' => 'Calle 123',
                'email' => 'administrador@adricastsystem.com',
                'password' => Hash::make('12345678'),
                'estado' => true,
                'tipo_usuario_id' => 1,
            ],
          
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            DB::table('users')->whereIn('name', ['Admin'])->delete();
            $table->dropColumn('username');
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
            $table->dropColumn('telefono');
            $table->dropColumn('direccion');
            $table->dropColumn('estado');
            $table->dropColumn('foto');
            $table->dropForeign(['tipousuario_id']);
            $table->dropColumn('tipousuario_id');

        });
    }
};
