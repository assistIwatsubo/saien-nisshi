<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year');
            $table->string('title');
            $table->foreignId('field_id')->constrained()->cascadeOnDelete();
            $table->enum('direction', ['vertical', 'horizontal']);
            $table->unsignedTinyInteger('gap');
            $table->text('memo')->nullable();
            $table->timestamps();

            $table->unique(['field_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layouts');
    }
};
