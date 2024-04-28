<?php

use App\Models\Module;
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
        Schema::create('module_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class);
            $table->foreignIdFor(Range::class);
            $table->json('item_cost');
            $table->json('unlock_condition');
            $table->json('trait_effect_type');
            $table->json('talent_effect');
            $table->string('talent_index')->nullable();
            $table->boolean('display_range');
            $table->json('attributes_blackboard');
            $table->integer('required_potential_rank');
            $table->json('token_attributes_blackboard');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_stages');
    }
};
