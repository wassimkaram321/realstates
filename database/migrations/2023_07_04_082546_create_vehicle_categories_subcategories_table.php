<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleCategoriesSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_categories_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_id');
            $table->timestamps();

            $table->foreign('cat_id')
            ->references('id')
            ->on('vehicle_categories')
            ->onDelete('cascade');

            $table->foreign('sub_id')
            ->references('id')
            ->on('vehicle_subcategories')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_categories_subcategories');
    }
}
