<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image',191)->default('user_default.png');
            $table->rememberToken();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('real_state_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('phone')->nullable();
            $table->integer('device_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            // $table->foreign('real_state_id')->references('id')->on('real_states')->onDelete('cascade');
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
