<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_header_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_header_id')->constrained()->cascadeOnDelete();

            $table->enum('layout', ['grid', 'split', 'card'])->default('grid');
            $table->enum('card_type', ['icon', 'image', 'cta'])->default('icon');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('order')->default(0);

            // Content
            $table->string('icon')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('icon_bg_color')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();

            // Card background
            $table->enum('background_type', ['image', 'color', 'gradient'])->default('color');
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('image_overlay_color')->nullable();
            $table->unsignedTinyInteger('image_overlay_opacity')->default(40);
            $table->unsignedSmallInteger('image_border_radius')->default(12);
            $table->string('image_position')->default('center');
            $table->string('image_size')->default('cover');

            // Gradient
            $table->string('gradient_type')->nullable();
            $table->string('gradient_color_1')->nullable();
            $table->string('gradient_color_2')->nullable();
            $table->unsignedSmallInteger('gradient_angle')->default(135);
            $table->string('overlay_color')->nullable();
            $table->unsignedTinyInteger('overlay_opacity')->default(0);

            // CTA / button
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->enum('button_style', ['filled', 'outline', 'ghost'])->default('filled');
            $table->unsignedSmallInteger('button_radius')->default(8);
            $table->string('button_bg_color')->nullable();
            $table->string('button_text_color')->nullable();
            $table->string('button_hover_bg_color')->nullable();
            $table->string('button_hover_text_color')->nullable();

            // Effects
            $table->string('hover_effect')->default('lift');
            $table->string('animation_type')->default('fade-up');
            $table->unsignedSmallInteger('animation_delay')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_header_cards');
    }
};
