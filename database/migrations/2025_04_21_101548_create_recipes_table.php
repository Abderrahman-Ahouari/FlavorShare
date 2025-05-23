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
            Schema::create('recipes', function (Blueprint $table) {
                $table->id();
                $table->string('title'); 
                $table->text('description');
                $table->string('cover_image')->nullable(); 
                $table->integer('preparation_time'); 
                $table->integer('servings');
                $table->foreignId('user_id')->constrained();
                $table->enum('status', ['banned', 'safe',])->default('safe');
                $table->string('video')->nullable(); 
                $table->enum('video_type', ['url', 'file', 'null'])->default('null');
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
