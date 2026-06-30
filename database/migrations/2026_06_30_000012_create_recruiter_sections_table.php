<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruiter_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('badge')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->enum('design_type', ['grid', 'marquee'])->default('grid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruiter_sections');
    }
};
