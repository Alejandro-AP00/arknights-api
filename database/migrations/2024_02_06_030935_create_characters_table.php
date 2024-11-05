<?php

use App\Enums\Position;
use App\Enums\Profession;
use App\Enums\Rarity;
use App\Enums\Subprofession;
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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class, 'owner_id')->nullable();
            $table->boolean('is_summon')->default(false);
            $table->foreignIdFor(Character::class, 'base_character_id')->nullable();
            $table->string('char_id');
            $table->json('name');
            $table->string('appellation');
            $table->enum('profession', Profession::values());
            $table->enum('sub_profession', SubProfession::values());
            $table->string('potential_item_id')->nullable();
            $table->boolean('can_use_general_potential_item');
            $table->text('description')->nullable();
            $table->string('nation')->nullable();
            $table->string('group')->nullable();
            $table->string('team')->nullable();
            $table->string('display_number')->nullable();
            $table->enum('position', Position::values());
            $table->enum('rarity', Rarity::values());
            $table->json('favor_key_frames')->nullable();
            $table->json('tag_list')->nullable();
            $table->boolean('is_limited')->default(false);
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
