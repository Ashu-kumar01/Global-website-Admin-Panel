<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('placement_sections', function (Blueprint $table) {
            $table->enum('design_type', ['grid', 'marquee'])->default('grid')->after('total_recruiters');
        });

        Schema::table('placement_logos', function (Blueprint $table) {
            $table->string('link')->nullable()->after('company_name');
        });
    }

    public function down(): void
    {
        Schema::table('placement_sections', function (Blueprint $table) {
            $table->dropColumn('design_type');
        });

        Schema::table('placement_logos', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
};
