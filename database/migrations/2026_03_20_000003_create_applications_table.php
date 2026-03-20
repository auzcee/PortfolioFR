<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('job_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->enum('status', ['applied', 'shortlisted', 'interview', 'hired', 'rejected'])->default('applied');
            $table->text('cover_letter')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'job_id']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
