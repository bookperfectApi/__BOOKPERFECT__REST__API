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
        Schema::create('userTable', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->unique();
            $table->string('userEmailID')->unique();
            $table->string('userCountry');
            $table->string('userAgency');
            $table->string('userSurname');
            $table->string('userProfile');
            $table->boolean('userIsB2C');
            $table->boolean('userRegisterViaAPI');
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
        Schema::dropIfExists('users');
    }
}
