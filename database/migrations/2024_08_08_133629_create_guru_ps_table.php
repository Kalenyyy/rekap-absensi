<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_ps', function (Blueprint $table) {
            $table->id('id_guru_ps'); // Primary key
            $table->string('nama'); // Column for nama
            $table->unsignedBigInteger('rayon_id'); // Foreign key referencing rayon
            $table->unsignedBigInteger('id_user'); // Foreign key referencing user
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraints
            $table->foreign('rayon_id')->references('id')->on('rayons')->onDelete('cascade');
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
        Schema::dropIfExists('guru_ps');
    }
}
