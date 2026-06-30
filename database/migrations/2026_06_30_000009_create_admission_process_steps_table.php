<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_process_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_process_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->string('icon')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_process_steps');
    }
};
