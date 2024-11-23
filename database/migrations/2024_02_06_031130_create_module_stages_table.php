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
            $table->integer('stage')->nullable();
            $table->json('item_cost');
            $table->json('attribute_blackboard')->nullable();
            $table->json('token_attribute_blackboard');
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
