<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ifso_members', function (Blueprint $table) {
            if (!Schema::hasColumn('ifso_members', 'reviewer_id')) {
                $table->foreignId('reviewer_id')
                      ->nullable()
                      ->constrained('users')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ifso_members', function (Blueprint $table) {
            if (Schema::hasColumn('ifso_members', 'reviewer_id')) {
                $table->dropForeign(['reviewer_id']);
                $table->dropColumn('reviewer_id');
            }
        });
    }
};