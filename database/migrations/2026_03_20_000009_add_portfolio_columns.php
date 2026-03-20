<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('portfolios')) {
            Schema::table('portfolios', function (Blueprint $table) {
                if (!Schema::hasColumn('portfolios', 'skills')) {
                    $table->text('skills')->nullable();
                }
                if (!Schema::hasColumn('portfolios', 'thumbnail')) {
                    $table->string('thumbnail')->nullable();
                }
                if (!Schema::hasColumn('portfolios', 'reviewed_at')) {
                    $table->timestamp('reviewed_at')->nullable();
                }
                if (!Schema::hasColumn('portfolios', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable();
                }
                if (!Schema::hasColumn('portfolios', 'status')) {
                    // Already exists, skip
                } else {
                    // Update the status enum if needed
                }
            });
        }
    }

    public function down(): void
    {
        //
    }
};
