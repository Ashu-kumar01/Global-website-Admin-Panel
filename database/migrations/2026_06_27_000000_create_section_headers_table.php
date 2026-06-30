<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Header
            $table->string('badge')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();

            $table->enum('layout_type', ['grid', 'split', 'card'])->default('grid');

            // Grid layout settings
            $table->unsignedTinyInteger('grid_columns_desktop')->default(3);
            $table->unsignedTinyInteger('grid_columns_tablet')->default(2);
            $table->unsignedTinyInteger('grid_columns_mobile')->default(1);
            $table->unsignedSmallInteger('grid_gap')->default(24);
            $table->unsignedSmallInteger('card_height')->nullable();
            $table->unsignedSmallInteger('card_border_radius')->default(12);
            $table->boolean('card_shadow')->default(true);
            $table->string('hover_animation')->default('lift');
            $table->boolean('image_zoom_hover')->default(true);
            $table->string('card_alignment')->default('center');

            // Split layout settings
            $table->enum('split_featured_position', ['left', 'right'])->default('left');

            // Card view settings
            $table->unsignedTinyInteger('card_view_columns')->default(3);

            // Section design settings
            $table->enum('section_background_type', ['color', 'image', 'gradient'])->default('color');
            $table->string('section_background_color')->nullable();
            $table->string('section_background_image')->nullable();
            $table->string('section_gradient_type')->nullable();
            $table->string('section_gradient_color_1')->nullable();
            $table->string('section_gradient_color_2')->nullable();
            $table->unsignedSmallInteger('section_gradient_angle')->default(135);
            $table->unsignedSmallInteger('padding_top')->default(80);
            $table->unsignedSmallInteger('padding_bottom')->default(80);
            $table->boolean('hover_shadow')->default(true);
            $table->unsignedSmallInteger('card_spacing')->default(24);
            $table->string('alignment')->default('center');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_headers');
    }
};
