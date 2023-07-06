<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cat_id'); //vehicle_categories
            $table->unsignedBigInteger('sub_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('rent_id')->nullable(); //from categories table {rent,sell}
            $table->float('price')->default('0');
            $table->string('image', 191)->default('vehicle_default.png');
            $table->text('slug');
            $table->float('latitude')->nullable();
            $table->float('longtitude')->nullable();
            $table->integer('status')->default(1); //for request ,changed when admin accepte it
            $table->integer('feature')->default(0);
            $table->integer('Recommended')->default(0);
            $table->integer('year')->default(0);
            $table->float('km')->default(0);
            $table->integer('ava')->default(1);
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
        Schema::dropIfExists('vehicles');
    }
}
