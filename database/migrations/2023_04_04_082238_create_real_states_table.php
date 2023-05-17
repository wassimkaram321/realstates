<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_states', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->unsignedBigInteger('cat_id');
            $table->string('cat_type','191');
            $table->string('address','191')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('price')->default('0');
            $table->float('space')->default('0');
            $table->string('image',191)->default('realestate_default.png');
            $table->text('slug');
            $table->float('latitude')->nullable();
            $table->float('longtitude')->nullable();
            $table->integer('status')->default(1);
            $table->integer('rent_time')->default(0);
            $table->integer('ava')->default(1);
            $table->timestamps();


            $table->foreign('city_id')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('set null');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_states');
    }
}
