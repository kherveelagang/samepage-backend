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
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('title');
            $table->string('author');
            $table->string('ISBN')->unique();
            $table->text('description')->nullable();
            $table->integer('publication_year');
            $table->string('image', 255)->nullable();
	        $table->enum('condition', ['excellent', 'good', 'fair', 'poor'])->	default('good');
            $table->timestamps();
	        $table->softDeletes();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');    
            $table->foreign('owner_id')->references('id')->on('users');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('department_id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};