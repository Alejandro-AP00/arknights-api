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
        Schema::create('base_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->string('buff_id');
            $table->string('skill_icon');
            $table->json('name');
            $table->json('description');
            $table->json('unlock_condition');
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
