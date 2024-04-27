<?php

use App\Models\Character;
use App\Models\Range;
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
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->foreignIdFor(Range::class);
            $table->string('character_prefab_key');
            $table->unsignedInteger('max_level');
            $table->json('evolve_cost');
            $table->json('attributes_key_frames');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
