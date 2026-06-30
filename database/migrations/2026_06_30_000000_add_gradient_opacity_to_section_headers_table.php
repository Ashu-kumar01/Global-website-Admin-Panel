<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('section_headers', function (Blueprint $table) {
            $table->unsignedTinyInteger('section_gradient_opacity')->default(100)->after('section_gradient_angle');
        });
    }

    public function down(): void
    {
        Schema::table('section_headers', function (Blueprint $table) {
            $table->dropColumn(['section_gradient_opacity']);
        });
    }
};
