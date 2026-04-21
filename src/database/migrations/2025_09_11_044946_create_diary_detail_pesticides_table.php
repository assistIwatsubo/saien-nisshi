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
        Schema::create('diary_detail_pesticides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_detail_id')->constrained('diary_details')->cascadeOnDelete();
            $table->foreignId('crop_field_id')->nullable()->constrained('crop_fields')->nullOnDelete();
            $table->foreignId('pesticide_id')->constrained('pesticides');
            $table->decimal('concentration', 5, 2)->nullable(); 
            $table->enum('concentration_unit', ['%', '割'])->nullable(); 
            $table->decimal('dilution_rate', 5, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable(); 
            $table->enum('amount_unit', ['L', 'ml', 'g', 'kg'])->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_detail_pesticides');
    }
};
