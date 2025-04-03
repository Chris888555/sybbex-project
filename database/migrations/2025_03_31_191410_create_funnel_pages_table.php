<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('funnel_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relate to users table
            $table->string('page_id')->unique(); // Unique Page ID
            $table->string('page_title'); // Page Title
            $table->json('content'); // Store content in JSON
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('funnel_pages');
    }
};

