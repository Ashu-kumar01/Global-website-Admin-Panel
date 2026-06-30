<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('recruiter_sections') && Schema::hasTable('placement_sections')) {
            DB::table('recruiter_sections')->orderBy('id')->each(function ($recruiterSection) {
                DB::table('placement_sections')
                    ->where('user_id', $recruiterSection->user_id)
                    ->update(['design_type' => $recruiterSection->design_type]);
            });
        }

        Schema::dropIfExists('recruiter_logos');
        Schema::dropIfExists('recruiter_sections');
    }

    public function down(): void
    {
        Schema::create('recruiter_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('badge')->nullable();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->enum('design_type', ['grid', 'marquee'])->default('grid');

            $table->timestamps();
        });

        Schema::create('recruiter_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->string('image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('link')->nullable();

            $table->timestamps();
        });
    }
};
