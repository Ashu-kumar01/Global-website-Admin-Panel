<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('placement_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('badge')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();

            $table->string('highest_package')->nullable();
            $table->string('average_package')->nullable();
            $table->string('total_recruiters')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placement_sections');
    }
};
