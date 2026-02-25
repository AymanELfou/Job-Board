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
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the saved_jobs table
            $table->foreignId('id_utilisateur')->constrained('users')->onDelete('cascade'); // Foreign key for users
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade'); // Foreign key for jobs
            $table->unsignedBigInteger('profile_id')->nullable(); // Reference without constraint since there are multiple profile tables
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};
