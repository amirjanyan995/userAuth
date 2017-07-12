<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('commentID');
            $table->string('content');
            $table->integer('postID')->unsigned();
            $table->integer('userID')->unsigned();
            $table->timestamps();

            $table->foreign('userID')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('postID')
                ->references('postID')->on('posts')
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
        Schema::dropIfExists('comments');
    }
}
