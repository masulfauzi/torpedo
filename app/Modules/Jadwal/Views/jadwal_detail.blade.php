@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('jadwal.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $jadwal->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $jadwal->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Guru</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->guru->id }}</p></div>
									<div class='col-lg-2'><p>Hari</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->hari->id }}</p></div>
									<div class='col-lg-2'><p>Jam Mulai</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->jamMulai->id }}</p></div>
									<div class='col-lg-2'><p>Jam Selesai</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->jamSelesai->id }}</p></div>
									<div class='col-lg-2'><p>Mapel</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->mapel->id }}</p></div>
									<div class='col-lg-2'><p>Ruang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->ruang->id }}</p></div>
									<div class='col-lg-2'><p>Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->sekolah->id }}</p></div>
									<div class='col-lg-2'><p>Semester</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->semester->id }}</p></div>
									<div class='col-lg-2'><p>Versi Jadwal</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $jadwal->versiJadwal->id }}</p></div>
									
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