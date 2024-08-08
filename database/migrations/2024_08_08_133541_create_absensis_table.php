<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('absensi'); // Primary key
            $table->unsignedBigInteger('id_siswa'); // Foreign key referencing the siswa
            $table->date('tanggal'); // Date field for Tanggal
            $table->time('waktu'); // Time field for Waktu
            $table->string('status'); // String field for Status
            $table->string('emoji')->nullable(); // String field for Emoji (can be null)
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraint
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
