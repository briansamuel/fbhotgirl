<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->text('post_description');
            $table->text('post_content');
            $table->string('post_keyword', 200);
            $table->string('post_thumbnail');
            $table->string('post_author', 100);
            $table->enum('post_status', ['pending', 'draft', 'publish']);
            $table->string('post_type', 20);
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
        Schema::dropIfExists('post');
    }
}
