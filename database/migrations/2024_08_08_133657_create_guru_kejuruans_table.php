<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruKejuruansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_kejuruans', function (Blueprint $table) {
            $table->id('id_guru'); // Primary key
            $table->string('nama'); // Column for nama
            $table->unsignedBigInteger('id_user'); // Foreign key referencing user
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_kejuruans');
    }
}
