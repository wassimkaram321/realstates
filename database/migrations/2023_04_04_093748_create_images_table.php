<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alt');
            $table->unsignedBigInteger('realstate_id');
            $table->unsignedBigInteger('vehicle_id');

            $table->foreign('realstate_id')
                ->references('id')
                ->on('real_states');

            $table->foreign('vehicle_id')
                ->references('id')
                ->on('vehicles');

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
        Schema::dropIfExists('images');
    }
}
