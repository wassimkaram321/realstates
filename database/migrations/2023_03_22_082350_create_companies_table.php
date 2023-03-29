<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('status')->default(0);
            $table->string('password');
            $table->string('image',191)->default('company_default.png');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->timestamps();
            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
