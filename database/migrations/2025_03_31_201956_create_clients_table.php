<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('user_id'); // Reference to the user who created the page
            $table->unsignedBigInteger('page_id'); // Reference to the page the client submitted from
            $table->timestamps();
    
            // Add foreign key constraints (if needed)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('funnel_pages')->onDelete('cascade');
        });
    }
    
};
