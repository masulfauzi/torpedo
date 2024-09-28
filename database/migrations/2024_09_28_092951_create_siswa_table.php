<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // your columns here
            $table->uuid('id_sekolah');
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_siswa');
            $table->uuid('id_jenis_kelamin');
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamin')->onDelete('restrict')->onUpdate('cascade');
            $table->date('tgl_masuk');
            $table->string('nisn');
            $table->string('nis');
            $table->string('no_ijazah_smp');
            $table->string('no_skhun_smp');
            $table->string('no_un_smp');
            $table->string('nik');
            $table->string('npsn_smp');
            $table->string('asal_sekolah');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->uuid('id_agama');
            $table->foreign('id_agama')->references('id')->on('agama')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_disabilitas');
            $table->foreign('id_disabilitas')->references('id')->on('disabilitas')->onDelete('restrict')->onUpdate('cascade');
            $table->text('alamat');
            $table->string('dusun');
            $table->string('rt');
            $table->string('rw');
            $table->uuid('id_desa');
            $table->foreign('id_desa')->references('id')->on('desa')->onDelete('restrict')->onUpdate('cascade');
            $table->string('kode_pos');
            $table->uuid('id_transportasi');
            $table->foreign('id_transportasi')->references('id')->on('transportasi')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_tempat_tinggal');
            $table->foreign('id_tempat_tinggal')->references('id')->on('tempat_tinggal')->onDelete('restrict')->onUpdate('cascade');
            $table->string('no_telp');
            $table->string('no_hp');
            $table->string('email');
            $table->string('no_kks');
            $table->boolean('is_kps');
            $table->string('no_kps');
            $table->boolean('is_pip');
            $table->uuid('id_alasan_pip');
            $table->foreign('id_alasan_pip')->references('id')->on('alasan_pip')->onDelete('restrict')->onUpdate('cascade');
            $table->boolean('is_kip');
            $table->string('no_kip');
            $table->string('nama_di_kip');
            $table->uuid('id_alasan_tolak_kip');
            $table->foreign('id_alasan_tolak_kip')->references('id')->on('alasan_tolak_kip')->onDelete('restrict')->onUpdate('cascade');
            $table->string('no_akta_lahir');
            $table->string('lintang');
            $table->string('bujur');

            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
