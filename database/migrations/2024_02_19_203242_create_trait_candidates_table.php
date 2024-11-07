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
        Schema::create('trait_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->foreignIdFor(Range::class)->nullable();
            $table->unsignedBigInteger('required_potential_rank');
            $table->json('unlock_condition');
            $table->json('blackboard');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trait_candidates');
    }
};
