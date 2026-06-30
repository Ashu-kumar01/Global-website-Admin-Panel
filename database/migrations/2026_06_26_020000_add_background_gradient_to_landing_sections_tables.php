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
        Schema::table('landing_sections', function (Blueprint $table) {
            $table->enum('background_gradient', ['solid', 'top', 'bottom', 'left', 'right', 'diagonal', 'radial'])
                ->default('solid')
                ->after('background_image');
        });

        Schema::table('landing_section_slides', function (Blueprint $table) {
            $table->enum('background_gradient', ['solid', 'top', 'bottom', 'left', 'right', 'diagonal', 'radial'])
                ->default('solid')
                ->after('background_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_sections', function (Blueprint $table) {
            $table->dropColumn('background_gradient');
        });

        Schema::table('landing_section_slides', function (Blueprint $table) {
            $table->dropColumn('background_gradient');
        });
    }
};