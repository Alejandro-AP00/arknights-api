<?php

use App\Models\ModuleStageUpgrade;
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
        Schema::create('module_stage_upgrade_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ModuleStageUpgrade::class);
            $table->foreignIdFor(Range::class)->nullable();
            $table->json('description')->nullable();
            $table->json('blackboard');
            $table->integer('required_potential_rank');
            $table->json('unlock_condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_stage_upgrade_candidates');
    }
};
