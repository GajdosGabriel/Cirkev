<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName', 50);
            $table->string('lastName', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->string('avatar', 200)->default(null);
            $table->string('roles', 10)->default('user');
            $table->string('phone', 15)->nullable();
            $table->string('profile_desc')->nullable();
            $table->text('about_user');
            $table->string('slug', 230);
            $table->boolean('send_email')->default(true);
            $table->boolean('verified')->default(false);
            $table->boolean('disabled')->default(false);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
