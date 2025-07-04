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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->date('data_nascimento');
            $table->enum('genero', ['M', 'F'])->nullable();
            $table->string('cnh')->unique();
            $table->string('telefone');
            $table->string('celular')->nullable();
            $table->string('logradouro')->after('cnh');
            $table->string('numero')->nullable()->after('logradouro');
            $table->string('bairro')->nullable()->after('numero');
            $table->string('cidade')->after('bairro');
            $table->string('estado', 2)->after('cidade');
            $table->string('cep', 9)->after('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
