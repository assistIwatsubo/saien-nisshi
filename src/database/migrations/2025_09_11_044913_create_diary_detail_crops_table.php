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
        Schema::create('diary_detail_crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_detail_id')->constrained('diary_details')->cascadeOnDelete();
            $table->foreignId('crop_field_id')->nullable()->constrained('crop_fields')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_detail_crops');
    }
};
