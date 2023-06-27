<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealestatBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('realestat_bookings')) {
            Schema::create('realestat_bookings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('request_id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('realestate_id');
                $table->unsignedBigInteger('booking_type');
                $table->timestamps();

                $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
                    ->onDelete('cascade');

                $table->foreign('realestate_id')
                    ->references('id')
                    ->on('real_states')
                    ->onDelete('cascade');

                $table->foreign('booking_type')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realestat_bookings');
    }
}
