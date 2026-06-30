<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruiter_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->string('image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('link')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruiter_logos');
    }
};
