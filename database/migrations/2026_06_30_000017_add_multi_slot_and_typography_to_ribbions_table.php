<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ribbions', function (Blueprint $table) {
            $table->unsignedTinyInteger('slot')->default(1)->after('user_id');
            $table->string('fontFamily')->nullable()->after('textColor');
            $table->unsignedSmallInteger('fontSize')->default(14)->after('fontFamily');
            $table->string('fontWeight')->default('600')->after('fontSize');
            $table->unsignedSmallInteger('ribbonHeight')->nullable()->after('fontWeight');

            $table->unique(['user_id', 'slot']);
        });
    }

    public function down(): void
    {
        Schema::table('ribbions', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'slot']);
            $table->dropColumn(['slot', 'fontFamily', 'fontSize', 'fontWeight', 'ribbonHeight']);
        });
    }
};
