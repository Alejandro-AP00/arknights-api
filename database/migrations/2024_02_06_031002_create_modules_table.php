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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class);
            $table->string('module_id');
            $table->string('icon_id');
            $table->json('name');
            $table->json('description');
            $table->string('type_icon');
            $table->string('type_name1');
            $table->string('type_name2')->nullable();
            $table->string('shining_color');
            $table->string('type');
            $table->integer('order_by');
            $table->json('unlock_condition');
            $table->json('unlock_missions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
