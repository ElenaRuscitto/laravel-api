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
        Schema::create('projects', function (Blueprint $table) {
           $table->id();

           $table->string('title', 60);
           $table->string('slug', 70)->unique();
           $table->text('link');
           $table->string('image')->nullable();
           $table->string('original_image')->nullable();
        //    $table->string('type')->nullable();
           $table->text('description')->nullable();

           $table->timestamps();
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
