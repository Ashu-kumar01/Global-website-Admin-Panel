<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('section_headers', function (Blueprint $table) {
            $table->string('heading_accent_text')->nullable()->after('heading');
            $table->string('heading_accent_color')->nullable()->default('#2563eb')->after('heading_accent_text');
            $table->string('heading_color')->nullable()->after('heading_accent_color');
            $table->string('subheading_color')->nullable()->after('subheading');
            $table->string('cta_text')->nullable()->after('alignment');
            $table->string('cta_link')->nullable()->after('cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('section_headers', function (Blueprint $table) {
            $table->dropColumn([
                'heading_accent_text',
                'heading_accent_color',
                'heading_color',
                'subheading_color',
                'cta_text',
                'cta_link',
            ]);
        });
    }
};
