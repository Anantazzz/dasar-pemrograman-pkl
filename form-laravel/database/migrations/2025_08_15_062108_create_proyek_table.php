<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->string('detail');
            $table->text('deskripsi');
            $table->enum('kategori', ['Penulisan Konten', 'Desain Grafis', 'Pengembangan Web']);
            $table->unsignedBigInteger('anggaran');
            $table->dateTime('batas_akhir');
            $table->string('lampiran')->nullable();
            $table->enum('lokasi_pengerjaan', ['onsite', 'remote']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyek');
    }
}
