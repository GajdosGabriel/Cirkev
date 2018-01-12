<?php

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
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title', 200);
            $table->text('body');
            $table->string('slug', 191)->index();
            $table->string('picture');
            $table->integer('count_view');
            $table->boolean('published')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('group_id')->unsigned();
            $table->string('video_link', 255)->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
