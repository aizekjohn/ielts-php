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
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('news_id')->nullable();
            $table->timestamps();

            $table->foreign('news_id')->references('id')->on('news')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_notifications');
    }
};
