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
        Schema::create('landing_section_buttons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landing_section_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('landing_section_slide_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('label');
            $table->string('link')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_section_buttons');
    }
};