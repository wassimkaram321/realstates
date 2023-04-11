<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealStateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_state_tags', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('realstate_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            // $table->foreign('realstate_id')
            // ->references('id')
            // ->on('real_states');
           
            // $table->foreign('tag_id')
            // ->references('id')
            // ->on('tags');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_state_tags');
    }
}
