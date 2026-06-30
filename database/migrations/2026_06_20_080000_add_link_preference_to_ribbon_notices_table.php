<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ribbon_notices', function (Blueprint $table) {
            $table->string('link_preference')->nullable()->after('file');
        });
    }

    public function down(): void
    {
        Schema::table('ribbon_notices', function (Blueprint $table) {
            $table->dropColumn('link_preference');
        });
    }
};
