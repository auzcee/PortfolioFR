<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'published', 'rejected', 'pending', 'approved'])->default('draft');
            $table->json('images')->nullable();
            $table->timestamp('synced_at')->nullable();
            $table->timestamp('last_sync_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
