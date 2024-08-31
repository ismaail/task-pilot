<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timelogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained('cards')->cascadeOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('finished_at');
            $table->unsignedInteger('elapsed_seconds');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timelogs');
    }
};
