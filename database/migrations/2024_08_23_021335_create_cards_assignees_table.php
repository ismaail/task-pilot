<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards_assignees', function (Blueprint $table) {
            $table->foreignId('card_id')->constrained('cards')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['card_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards_assignees');
    }
};
