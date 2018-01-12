<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
//            $table->string('intro');
            $table->string('slug');
            $table->text('body');
            $table->dateTime('dateStart');
//            $table->date('dateEnd')->nullable();
            $table->time('timeStart');
            $table->time('timeEnd')->nullable();
            $table->string('organizator');
            $table->string('street')->nullable();
            $table->string('city');
            $table->string('picture')->nullable();
            $table->string('appendFile')->nullable();
            $table->string('region');
            $table->integer('count_view')->nullable()->default(0);
            $table->string('registration');
            $table->string('entryFee');
            $table->boolean('published')->default(1);
//            $table->string('eventType');
            $table->boolean('disabled')->default(0);
            $table->unsignedInteger('user_id');
            $table->string('clientwww')->nullable();
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
        Schema::dropIfExists('events');
    }
}
