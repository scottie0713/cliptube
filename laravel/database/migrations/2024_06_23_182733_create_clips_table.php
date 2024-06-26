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
        Schema::create('clips', function (Blueprint $table) {
            $table->id();
            $table->string('video_id');
            $table->string('title');
            $table->integer('start_sec');
            $table->integer('end_sec')->nullable();
            $table->integer('point')->default(0);
            $table->timestamps();
            $table->index(['video_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clips');
    }
};
