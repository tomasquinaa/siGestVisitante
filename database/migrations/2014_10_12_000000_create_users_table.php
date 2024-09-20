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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Coluna de departamento
            $table->unsignedBigInteger('departament_id')->nullable();
            $table->foreign('departament_id')
                  ->references('id')
                  ->on('departments') // Nome correto da tabela 'departments'
                  ->onDelete('set null');

            // Coluna de empresa
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remover chaves estrangeiras
            $table->dropForeign(['departament_id']);
            $table->dropForeign(['company_id']);
        });

        // Remover a tabela `users`
        Schema::dropIfExists('users');
    }
};
