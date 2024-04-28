<?php

use App\Models\Character;
use App\Models\Range;
use App\Models\Talent;
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
        Schema::create('talent_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Talent::class);
            $table->foreignIdFor(Range::class);
            $table->foreignIdFor(Character::class);
            $table->unsignedBigInteger('required_potential_rank');
            $table->json('unlock_condition');
            $table->json('name');
            $table->json('description');
            $table->json('blackboard');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_candidates');
    }
};
