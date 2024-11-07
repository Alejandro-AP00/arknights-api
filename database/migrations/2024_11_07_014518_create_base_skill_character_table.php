<?php

use App\Models\BaseSkill;
use App\Models\Character;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('base_skill_character', function (Blueprint $table) {
            $table->foreignIdFor(Character::class);
            $table->foreignIdFor(BaseSkill::class);
            $table->json('unlock_condition');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_base_skill');
    }
};
