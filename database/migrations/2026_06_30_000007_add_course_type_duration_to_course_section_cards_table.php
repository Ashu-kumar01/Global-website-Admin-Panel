<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_section_cards', function (Blueprint $table) {
            $table->enum('course_type', ['full_time', 'part_time'])->nullable()->after('short_description');
            $table->string('duration')->nullable()->after('course_type');
        });
    }

    public function down(): void
    {
        Schema::table('course_section_cards', function (Blueprint $table) {
            $table->dropColumn(['course_type', 'duration']);
        });
    }
};
