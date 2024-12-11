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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_employeur')->constrained('profil_employers')->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->string('location');
            $table->string('job_type');
            $table->string('categorie')->nullable();
            $table->decimal('salaire', 10, 2)->nullable();
            $table->string('type_contrat')->nullable();
            $table->date('date_publication');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
