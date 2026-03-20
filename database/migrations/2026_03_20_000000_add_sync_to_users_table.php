<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role column with enum
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'user', 'moderator'])->default('user')->after('password');
            }

            // Add sync tracking columns
            if (!Schema::hasColumn('users', 'last_sync_at')) {
                $table->timestamp('last_sync_at')->nullable()->after('role');
            }

            if (!Schema::hasColumn('users', 'sync_device_id')) {
                $table->string('sync_device_id')->nullable()->after('last_sync_at');
            }

            // Soft deletes for Flutter sync
            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'last_sync_at', 'sync_device_id', 'deleted_at']);
        });
    }
};
