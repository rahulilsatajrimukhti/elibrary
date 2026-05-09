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
            $table->id();
            $table->foreignId('category_id')
                ->constrained('book_categories')
                ->cascadeOnDelete();

            $table->foreignId('author_id')
                ->constrained('authors')
                ->cascadeOnDelete();

            $table->foreignId('publisher_id')
                ->constrained('publishers')
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('isbn')
                ->nullable();

            $table->year('publish_year')
                ->nullable();

            $table->integer('stock')
                ->default(0);

            $table->string('cover')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);
            $table->timestamps();
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
