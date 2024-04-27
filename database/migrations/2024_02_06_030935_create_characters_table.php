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
            $table->string('char_id');
            $table->string('alter_char_id')->nullable();
            $table->string('base_operator_char_id')->nullable();
            $table->boolean('is_summon');
            $table->unsignedInteger('release_order');
            $table->string('name');
            $table->string('appellation');
            $table->enum('profession', Profession::names());
            $table->enum('sub_profession', SubProfession::names());
            $table->string('potential_item_id')->nullable();
            $table->boolean('can_use_general_potential_item');
            $table->text('description')->nullable();
            $table->string('nation')->nullable();
            $table->string('group')->nullable();
            $table->string('team')->nullable();
            $table->string('display_number')->nullable();
            $table->enum('position', Position::values());
            $table->enum('rarity', Rarity::values());
            $table->json('favor_key_frames');
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