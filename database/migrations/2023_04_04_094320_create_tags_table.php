<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2023_04_19_091821_create_message_table.php
class CreateMessageTable extends Migration
========
class CreateTagsTable extends Migration
>>>>>>>> 1e9ed069c42d2481e44ffe41aab1922a23e381ac:database/migrations/2023_04_04_094320_create_tags_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<<< HEAD:database/migrations/2023_04_19_091821_create_message_table.php
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('message');
========
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
>>>>>>>> 1e9ed069c42d2481e44ffe41aab1922a23e381ac:database/migrations/2023_04_04_094320_create_tags_table.php
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
<<<<<<<< HEAD:database/migrations/2023_04_19_091821_create_message_table.php
        Schema::dropIfExists('message');
========
        Schema::dropIfExists('tags');
>>>>>>>> 1e9ed069c42d2481e44ffe41aab1922a23e381ac:database/migrations/2023_04_04_094320_create_tags_table.php
    }
}
