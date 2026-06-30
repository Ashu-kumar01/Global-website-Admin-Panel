<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_page_id')->constrained()->cascadeOnDelete();
            $table->string('section_key');
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('is_configured')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['home_page_id', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_sections');
    }
};
