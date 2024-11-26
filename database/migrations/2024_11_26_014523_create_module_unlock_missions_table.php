<?php

use App\Models\Module;
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
        Schema::create('module_unlock_missions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class);
            $table->string('mission_id');
            $table->json('description');
            $table->string('jump_stage_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_unlock_missions');
    }
};
