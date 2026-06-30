<?php

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
        Schema::create('landing_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('screen_type', ['single', 'slider', 'scroll'])->default('single');

            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->enum('position', ['left', 'center', 'right'])->default('left');

            $table->enum('background_type', ['color', 'image', 'image_fade'])->default('color');
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->unsignedTinyInteger('background_fade_opacity')->default(50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_sections');
    }
};