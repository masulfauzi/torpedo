@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('siswa.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $siswa->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $siswa->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Alamat</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->alamat }}</p></div>
									<div class='col-lg-2'><p>Asal Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->asal_sekolah }}</p></div>
									<div class='col-lg-2'><p>Bujur</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->bujur }}</p></div>
									<div class='col-lg-2'><p>Dusun</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->dusun }}</p></div>
									<div class='col-lg-2'><p>Email</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->email }}</p></div>
									<div class='col-lg-2'><p>Agama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->agama->id }}</p></div>
									<div class='col-lg-2'><p>Alasan Pip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->alasanPip->id }}</p></div>
									<div class='col-lg-2'><p>Alasan Tolak Kip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->alasanTolakKip->id }}</p></div>
									<div class='col-lg-2'><p>Desa</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->desa->id }}</p></div>
									<div class='col-lg-2'><p>Disabilitas</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->disabilitas->id }}</p></div>
									<div class='col-lg-2'><p>Jenis Kelamin</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->jenisKelamin->id }}</p></div>
									<div class='col-lg-2'><p>Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->sekolah->id }}</p></div>
									<div class='col-lg-2'><p>Tempat Tinggal</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tempatTinggal->id }}</p></div>
									<div class='col-lg-2'><p>Transportasi</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->transportasi->id }}</p></div>
									<div class='col-lg-2'><p>Is Kip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->is_kip }}</p></div>
									<div class='col-lg-2'><p>Is Kps</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->is_kps }}</p></div>
									<div class='col-lg-2'><p>Is Pip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->is_pip }}</p></div>
									<div class='col-lg-2'><p>Kode Pos</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->kode_pos }}</p></div>
									<div class='col-lg-2'><p>Lintang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->lintang }}</p></div>
									<div class='col-lg-2'><p>Nama Di Kip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nama_di_kip }}</p></div>
									<div class='col-lg-2'><p>Nama Siswa</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nama_siswa }}</p></div>
									<div class='col-lg-2'><p>Nik</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nik }}</p></div>
									<div class='col-lg-2'><p>Nis</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nis }}</p></div>
									<div class='col-lg-2'><p>Nisn</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nisn }}</p></div>
									<div class='col-lg-2'><p>No Akta Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_akta_lahir }}</p></div>
									<div class='col-lg-2'><p>No Hp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_hp }}</p></div>
									<div class='col-lg-2'><p>No Ijazah Smp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_ijazah_smp }}</p></div>
									<div class='col-lg-2'><p>No Kip</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_kip }}</p></div>
									<div class='col-lg-2'><p>No Kks</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_kks }}</p></div>
									<div class='col-lg-2'><p>No Kps</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_kps }}</p></div>
									<div class='col-lg-2'><p>No Skhun Smp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_skhun_smp }}</p></div>
									<div class='col-lg-2'><p>No Telp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_telp }}</p></div>
									<div class='col-lg-2'><p>No Un Smp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_un_smp }}</p></div>
									<div class='col-lg-2'><p>Npsn Smp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->npsn_smp }}</p></div>
									<div class='col-lg-2'><p>Rt</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->rt }}</p></div>
									<div class='col-lg-2'><p>Rw</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->rw }}</p></div>
									<div class='col-lg-2'><p>Tgl Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tgl_lahir }}</p></div>
									<div class='col-lg-2'><p>Tgl Masuk</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tgl_masuk }}</p></div>
									<div class='col-lg-2'><p>Tmp Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tmp_lahir }}</p></div>
									
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