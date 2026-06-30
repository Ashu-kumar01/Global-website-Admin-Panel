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
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('badge');
            $table->string('heading');
            $table->text('subheading');
            $table->enum('aboutPosition', ['left', 'center', 'right'])->default('left');

            $table->string('button_label');
            $table->string('aboutBtnLink');

            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->enum('aboutImage1Position', ['left', 'right', 'top', 'bottom'])->default('left');
            $table->enum('aboutImage2Position', ['left', 'right', 'top', 'bottom'])->default('left');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
