<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('info_text', 100)->nullable();
            $table->boolean('verim')->default(false);
            $table->boolean('homegroupe')->default(false);
            $table->boolean('healing')->default(false);
            $table->boolean('exorsizmus')->default(false);
            $table->boolean('babtise')->default(false);
            $table->boolean('diakon')->default(false);
            $table->boolean('mariageservice')->default(false);
            $table->boolean('frontAuthor')->default(false);
            $table->boolean('church_employee')->default(false);
            $table->boolean('rehola')->default(false);
            $table->boolean('ministrant')->default(false);
            $table->boolean('missioner')->default(false);
            $table->enum('gender', ['M', 'F'])->default(null);
            $table->boolean('christian_abroad')->default(false);
            $table->integer('denomination_id')->unsigned()->nullable();
            $table->double('lng', 16, 14)->nullable();
            $table->double('lat', 16, 14)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
