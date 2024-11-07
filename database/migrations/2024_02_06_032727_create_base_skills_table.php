<?php

use App\Enums\BaseBuffCategory;
use App\Enums\RoomType;
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
        Schema::create('base_skills', function (Blueprint $table) {
            $table->id();
            $table->string('buff_id');
            $table->string('skill_icon');
            $table->json('name');
            $table->json('description');
            $table->string('buff_color');
            $table->string('text_color');
            $table->enum('room_type', RoomType::values());
            $table->enum('buff_category', BaseBuffCategory::values());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_skills');
    }
};
