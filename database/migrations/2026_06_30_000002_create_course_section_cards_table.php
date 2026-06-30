<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_section_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->string('badge')->nullable();
            $table->string('explore_text')->nullable();
            $table->string('explore_link')->nullable();
            $table->string('image')->nullable();
            $table->string('background_color')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_section_cards');
    }
};
