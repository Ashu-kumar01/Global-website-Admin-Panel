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
        Schema::create('ribbions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable();
            $table->string('file')->nullable();

            $table->string('backgroundColor')->nullable();
            $table->string('textColor')->nullable();

            $table->string('ribbonPosition')->nullable();
            $table->string('position')->nullable();

            $table->boolean('ribbonCloseBtnRadio')->default(false);

            $table->string('ribbonAnimation')->nullable();

            $table->integer('sliderSpeed')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ribbions');
    }
};
