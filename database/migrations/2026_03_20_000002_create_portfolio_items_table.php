<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // 'image', 'video', 'text', etc.
            $table->integer('position')->default(0);
            $table->json('content');
            $table->softDeletes();
            $table->timestamps();

            $table->index('portfolio_id');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
