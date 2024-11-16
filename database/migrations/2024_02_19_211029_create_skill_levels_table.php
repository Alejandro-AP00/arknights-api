<?php

use App\Models\Range;
use App\Models\Skill;
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
        Schema::create('skill_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Skill::class);
            $table->foreignIdFor(Range::class)->nullable();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('skill_type');
            $table->string('duration_type');
            $table->json('sp_data');
            $table->integer('duration');
            $table->json('blackboard');
            $table->json('lvl_up_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_levels');
    }
};
