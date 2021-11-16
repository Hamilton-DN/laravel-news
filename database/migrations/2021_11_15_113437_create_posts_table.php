<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['draft', 'active', 'expired'])->default('draft');
            $table->timestamps();
        });
        Schema::create('post_categories', function (Blueprint $table) {
            $table->foreignId('post_id')
                ->constrained();
            $table->foreignId('category_id')
                ->constrained();
            $table->timestamps();
        });
        Schema::create('post_tags', function (Blueprint $table) {
            $table->foreignId('post_id')
                ->constrained();
            $table->foreignId('category_id')
                ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('posts');
    }
}
