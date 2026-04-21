<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diary_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_id')->constrained('diaries')->cascadeOnDelete();
            $table->enum('type', ['crop', 'pesticide', 'other'])->default('other');
            $table->unsignedInteger('position')->default(0);
            $table->text('memo')->nullable();
            $table->timestamps();
            
            $table->index(['diary_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_details');
    }
};
