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
        Schema::create('writing_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('writing_category_id');
            $table->foreign('writing_category_id')->references('id')->on('writing_categories');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_questions');
    }
};
