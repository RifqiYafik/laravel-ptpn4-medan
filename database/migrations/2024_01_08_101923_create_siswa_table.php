<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->integer('id_siswa');
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('alamat');
            $table->integer('sekolah_id');
            $table->integer('penempatan_id');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->bigInteger('no_hp');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
