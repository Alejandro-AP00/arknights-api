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
        Schema::create('potentials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->string('type')->nullable();
            $table->json('description')->nullable();
            $table->json('buff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potentials');
    }
};
