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
            $table->unsignedSmallInteger('order')->default(999);
        });

        Schema::table('writing_questions', function (Blueprint $table) {
            $table->unsignedSmallInteger('order')->default(999);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('speaking_questions', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('writing_questions', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
