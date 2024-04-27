<?php

use App\Models\Character;
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
        Schema::create('handbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->json('profile')->nullable();
            $table->json('basic_info')->nullable();
            $table->json('physical_exam')->nullable();
            $table->json('clinical_analysis')->nullable();
            $table->json('promotion_record')->nullable();
            $table->json('performance_review')->nullable();
            $table->json('class_conversion_record')->nullable();
            $table->json('archives')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handbooks');
    }
};
