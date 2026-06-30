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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'lname')) {
                $table->string('lname')->nullable()->after('fname');
            }
            if (!Schema::hasColumn('users', 'email_id')) {
                $table->string('email_id')->nullable()->unique()->after('email');
            }
            if (!Schema::hasColumn('users', 'mobile_number')) {
                $table->string('mobile_number')->nullable()->unique()->after('email_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fname', 'lname', 'email_id', 'mobile_number']);
        });
    }
};
