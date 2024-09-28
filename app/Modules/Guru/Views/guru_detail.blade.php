@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('guru.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('guru.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $guru->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $guru->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Alamat</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->alamat }}</p></div>
									<div class='col-lg-2'><p>Bujur</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->bujur }}</p></div>
									<div class='col-lg-2'><p>Dusun</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->dusun }}</p></div>
									<div class='col-lg-2'><p>Email</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->email }}</p></div>
									<div class='col-lg-2'><p>Gelar Belakang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->gelar_belakang }}</p></div>
									<div class='col-lg-2'><p>Gelar Depan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->gelar_depan }}</p></div>
									<div class='col-lg-2'><p>Agama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->agama->id }}</p></div>
									<div class='col-lg-2'><p>Desa</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->desa->id }}</p></div>
									<div class='col-lg-2'><p>Disabilitas</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->disabilitas->id }}</p></div>
									<div class='col-lg-2'><p>Jenis Kelamin</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->jenisKelamin->id }}</p></div>
									<div class='col-lg-2'><p>Pekerjaan Pasangan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->pekerjaanPasangan->id }}</p></div>
									<div class='col-lg-2'><p>Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->sekolah->id }}</p></div>
									<div class='col-lg-2'><p>Status Kepegawaian</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->statusKepegawaian->id }}</p></div>
									<div class='col-lg-2'><p>Status Perkawinan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->statusPerkawinan->id }}</p></div>
									<div class='col-lg-2'><p>Kode Pos</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->kode_pos }}</p></div>
									<div class='col-lg-2'><p>Lintang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->lintang }}</p></div>
									<div class='col-lg-2'><p>Nama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nama }}</p></div>
									<div class='col-lg-2'><p>Nama Ibu Kandung</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nama_ibu_kandung }}</p></div>
									<div class='col-lg-2'><p>Nama Pasangan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nama_pasangan }}</p></div>
									<div class='col-lg-2'><p>Nik</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nik }}</p></div>
									<div class='col-lg-2'><p>Nip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nip }}</p></div>
									<div class='col-lg-2'><p>No Hp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->no_hp }}</p></div>
									<div class='col-lg-2'><p>No Kk</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->no_kk }}</p></div>
									<div class='col-lg-2'><p>Npwp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->npwp }}</p></div>
									<div class='col-lg-2'><p>Nuptk</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->nuptk }}</p></div>
									<div class='col-lg-2'><p>Rt</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->rt }}</p></div>
									<div class='col-lg-2'><p>Rw</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->rw }}</p></div>
									<div class='col-lg-2'><p>Sk Pengangkatan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->sk_pengangkatan }}</p></div>
									<div class='col-lg-2'><p>Tgl Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->tgl_lahir }}</p></div>
									<div class='col-lg-2'><p>Tmp Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->tmp_lahir }}</p></div>
									<div class='col-lg-2'><p>Tmt Pengangkatan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $guru->tmt_pengangkatan }}</p></div>
									
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection