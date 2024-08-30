<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bucket_id')->constrained('buckets')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('archived')->default(false);
            $table->unsignedBigInteger('sort')->nullable();
            $table->unsignedBigInteger('spent_seconds')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
