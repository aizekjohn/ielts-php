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
        Schema::table('speaking_questions', function (Blueprint $table) {
            $table->dropForeign(['speaking_category_id']);
            $table->foreign('speaking_category_id')
                ->references('id')
                ->on('speaking_categories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('speaking_questions', function (Blueprint $table) {
            $table->dropForeign(['speaking_category_id']);
            $table->foreign('speaking_category_id')->references('id')->on('speaking_categories');
        });
    }
};
