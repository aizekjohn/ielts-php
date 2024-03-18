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
        Schema::table('writing_questions', function (Blueprint $table) {
            $table->dropForeign(['writing_category_id']);
            $table->foreign('writing_category_id')
                ->references('id')
                ->on('writing_categories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('writing_questions', function (Blueprint $table) {
            $table->dropForeign(['writing_category_id']);
            $table->foreign('writing_category_id')->references('id')->on('writing_categories');
        });
    }
};
