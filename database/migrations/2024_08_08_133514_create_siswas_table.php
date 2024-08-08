<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('nama'); // Column for nama
            $table->unsignedBigInteger('rayon_id'); // Foreign key for rayon
            $table->string('nis'); // Column for NIS
            $table->string('foto_siswa')->nullable(); // Column for foto_siswa (can be null)
            $table->unsignedBigInteger('id_user'); // Foreign key for user
            $table->unsignedBigInteger('id_rombel'); // Foreign key for rombel
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
