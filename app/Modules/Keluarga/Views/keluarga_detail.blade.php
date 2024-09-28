@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('keluarga.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('keluarga.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $keluarga->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $keluarga->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Disabilitas</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->disabilitas->id }}</p></div>
									<div class='col-lg-2'><p>Hub Keluarga</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->hubKeluarga->id }}</p></div>
									<div class='col-lg-2'><p>Pekerjaan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->pekerjaan->id }}</p></div>
									<div class='col-lg-2'><p>Pendidikan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->pendidikan->id }}</p></div>
									<div class='col-lg-2'><p>Penghasilan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->penghasilan->id }}</p></div>
									<div class='col-lg-2'><p>Siswa</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->siswa->id }}</p></div>
									<div class='col-lg-2'><p>Nama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->nama }}</p></div>
									<div class='col-lg-2'><p>Nik</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->nik }}</p></div>
									<div class='col-lg-2'><p>Tgl Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->tgl_lahir }}</p></div>
									<div class='col-lg-2'><p>Tmp Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $keluarga->tmp_lahir }}</p></div>
									
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