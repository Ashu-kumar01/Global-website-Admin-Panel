<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_section_cards', function (Blueprint $table) {
            $table->text('short_description')->nullable()->after('subheading');
        });
    }

    public function down(): void
    {
        Schema::table('course_section_cards', function (Blueprint $table) {
            $table->dropColumn('short_description');
        });
    }
};
