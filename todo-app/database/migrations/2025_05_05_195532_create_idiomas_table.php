<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 5)->unique(); // Ex: pt, en, fr
            $table->string('nome');                // Ex: Português, English
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        // Inserir idiomas padrão
        DB::table('idiomas')->insert([
            ['codigo' => 'pt', 'nome' => 'Português', 'ativo' => true],
            ['codigo' => 'en', 'nome' => 'English', 'ativo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('idiomas');
    }
};
