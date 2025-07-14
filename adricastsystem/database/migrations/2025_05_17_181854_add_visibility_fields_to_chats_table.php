<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->boolean('visible_sender')->default(true)->after('estado');
            $table->boolean('visible_receiver')->default(true)->after('visible_sender');
        });

        // Asegurarse de que todos los registros existentes estén visibles
        DB::table('chats')->update([
            'visible_sender' => true,
            'visible_receiver' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn(['visible_sender', 'visible_receiver']);
        });
    }
};
