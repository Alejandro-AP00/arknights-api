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
        Schema::create('skins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->string('skin_id');
            $table->string('illust_id');
            $table->string('avatar_id');
            $table->string('portrait_id');
            $table->json('name');
            $table->json('display_skin');
            $table->string('type');
            $table->json('obtain_sources')->nullable();
            $table->integer('cost')->nullable();
            $table->string('token_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skins');
    }
};
