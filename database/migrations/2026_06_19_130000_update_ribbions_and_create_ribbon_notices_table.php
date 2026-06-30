<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ribbions', function (Blueprint $table) {
            $table->dropColumn(['name', 'link', 'file']);
        });

        Schema::create('ribbon_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ribbion_id')->constrained('ribbions')->cascadeOnDelete();
            $table->string('name');
            $table->string('link')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ribbon_notices');

        Schema::table('ribbions', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('file')->nullable();
        });
    }
};
