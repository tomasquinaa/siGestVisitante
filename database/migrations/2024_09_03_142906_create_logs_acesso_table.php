<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs_acesso', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('descricao', 345)->nullable()->collation('utf8mb3_general_ci');
            $table->string('browser', 255)->nullable()->collation('utf8mb3_general_ci');
            $table->string('ip', 45)->nullable()->collation('utf8mb3_general_ci');
            $table->string('informacao', 455)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('nome_maquina', 145)->nullable()->collation('utf8mb3_general_ci');
            $table->string('name', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('agente', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('so', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('user_id')->nullable();
            // Removendo a coluna estado_id
            // $table->unsignedBigInteger('estado_id')->nullable();
            $table->timestamps(); // Cria as colunas created_at e updated_at
            $table->unsignedInteger('deleted_at')->nullable();

            // Índices
            $table->index('user_id', 'FK_logs_acesso_users');
            // Removendo o índice para estado_id
            // $table->index('estado_id', 'FK_logs_acesso_estado');

            // Chaves estrangeiras
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
  
        });

        // Configuração adicional
        DB::statement('ALTER TABLE logs_acesso ENGINE=InnoDB ROW_FORMAT=DYNAMIC AUTO_INCREMENT=10 COLLATE=utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_acesso');
    }
};
