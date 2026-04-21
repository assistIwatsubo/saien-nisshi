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
        Schema::create('ridge_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ridge_id')->constrained()->cascadeOnDelete();
            $table->foreignId('crop_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('ratio')->default(100);
            $table->unsignedTinyInteger('position');
            $table->timestamps();

            $table->unique(['ridge_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ridge_details');
    }
};
