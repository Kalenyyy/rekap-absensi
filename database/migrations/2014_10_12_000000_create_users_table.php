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
            $table->id('id_user'); // Mengganti id default dengan id_user
            $table->string('username')->unique(); // Mengganti name dengan username dan menambahkan unique
            $table->string('password');
            $table->integer('role'); // Menambahkan role
            $table->timestamps(); // Menambahkan created_at dan updated_at secara otomatis
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

