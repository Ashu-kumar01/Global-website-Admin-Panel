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
            $table->string('organisation_name')->nullable()->after('password');
            $table->string('website_name')->nullable();
            $table->string('domain')->nullable();
            $table->string('website_type')->nullable();
            $table->text('web_descroption')->nullable();
            $table->string('location')->nullable();
            $table->string('target_audience')->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();

            $table->string('logo')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('tagline')->nullable();
            $table->text('notes')->nullable();

            $table->boolean('terms')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'organisation_name',
                'website_name',
                'domain',
                'website_type',
                'web_descroption',
                'location',
                'target_audience',
                'facebook',
                'instagram',
                'twitter',
                'linkedIn',
                'youtube',
                'whatsapp',
                'logo',
                'primary_color',
                'tagline',
                'notes',
                'terms'
            ]);
        });
    }
};
