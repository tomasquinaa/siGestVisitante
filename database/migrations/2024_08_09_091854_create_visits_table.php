<?php

use App\Enums\PassStatus;
use App\Enums\TypeVisit;
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

        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('department_id')->constrained('departments')->onDelete('cascade'); obrigatorio
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('name');
            $table->string('document_number');
            $table->string('contact')->nullable();
            $table->string('related_person')->nullable(); // Pessoa relacionada à visita, como em uma reunião

            // Campo para o tipo de visita
            $table->enum('visit_type', [
                TypeVisit::REUNIAO->value,
                TypeVisit::ESTATAL->value,
                TypeVisit::INSPECAO->value
            ]);

            // Campo para o status do passe
            $table->enum('pass_given', [
                PassStatus::RECEIVED->value,
                PassStatus::NOT_RECEIVED->value
            ])->default(PassStatus::NOT_RECEIVED->value); // Indica se o passe foi dado

            $table->time('entry_time');
            $table->time('exit_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
