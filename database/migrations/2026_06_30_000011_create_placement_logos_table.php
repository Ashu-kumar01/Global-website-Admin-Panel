<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('placement_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('placement_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->string('image')->nullable();
            $table->string('company_name')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placement_logos');
    }
};
