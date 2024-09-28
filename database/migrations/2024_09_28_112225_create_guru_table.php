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
        Schema::create('guru', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // your columns here
            $table->uuid('id_sekolah');
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->uuid('id_jenis_kelamin');
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamin')->onDelete('restrict')->onUpdate('cascade');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('nama_ibu_kandung');
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('dusun');
            $table->uuid('id_desa');
            $table->foreign('id_desa')->references('id')->on('desa')->onDelete('restrict')->onUpdate('cascade');
            $table->string('kode_pos');
            $table->string('lintang');
            $table->string('bujur');
            $table->string('no_kk');
            $table->uuid('id_agama');
            $table->foreign('id_agama')->references('id')->on('agama')->onDelete('restrict')->onUpdate('cascade');
            $table->string('npwp')->unique();
            $table->string('nik');
            $table->uuid('id_status_perkawinan');
            $table->foreign('id_status_perkawinan')->references('id')->on('status_perkawinan')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_pasangan');
            $table->uuid('id_pekerjaan_pasangan');
            $table->foreign('id_pekerjaan_pasangan')->references('id')->on('pekerjaan')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_disabilitas');
            $table->foreign('id_disabilitas')->references('id')->on('disabilitas')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_status_kepegawaian');
            $table->foreign('id_status_kepegawaian')->references('id')->on('status_kepegawaian')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nuptk')->unique();
            $table->string('sk_pengangkatan');
            $table->date('tmt_pengangkatan');
            $table->string('no_hp');
            $table->string('email');


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
        Schema::dropIfExists('guru');
    }
};
