<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('postID');
            $table->string('title',255);
            $table->text('miniDescription');
            $table->longText('description');
            $table->string('imgPath')->nullable();
            $table->integer('authorID')->unsigned();
            $table->integer('categoryID')->unsigned();
            $table->timestamps();

            $table->foreign('authorID')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('categoryID')
                ->references('categoryID')->on('category')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
