<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('current_card_id')
                ->after('remember_token')
                ->nullable()
                ->constrained('cards')->cascadeOnDelete();
            $table->timestamp('current_card_at')->nullable()->after('current_card_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_card_id');
        });
    }
};
