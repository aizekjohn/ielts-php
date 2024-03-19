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
        Schema::table('speaking_answers', function (Blueprint $table) {
            $table->string('title')->default('Title');
        });

        Schema::table('writing_answers', function (Blueprint $table) {
            $table->string('title')->default('Title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('speaking_answers', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('writing_answers', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
