@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Data {{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Tabel Data {{ $title }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <form action="{{ route('guru.index') }}" method="get">
                            <div class="form-group col-md-3 has-icon-left position-relative">
                                <input type="text" class="form-control" value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                <div class="form-control-icon"><i class="fa fa-search"></i></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">  
						{!! button('guru.create', $title) !!}  
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>Alamat</td>
								<td>Bujur</td>
								<td>Dusun</td>
								<td>Email</td>
								<td>Gelar Belakang</td>
								<td>Gelar Depan</td>
								<td>Agama</td>
								<td>Desa</td>
								<td>Disabilitas</td>
								<td>Jenis Kelamin</td>
								<td>Pekerjaan Pasangan</td>
								<td>Sekolah</td>
								<td>Status Kepegawaian</td>
								<td>Status Perkawinan</td>
								<td>Kode Pos</td>
								<td>Lintang</td>
								<td>Nama</td>
								<td>Nama Ibu Kandung</td>
								<td>Nama Pasangan</td>
								<td>Nik</td>
								<td>Nip</td>
								<td>No Hp</td>
								<td>No Kk</td>
								<td>Npwp</td>
								<td>Nuptk</td>
								<td>Rt</td>
								<td>Rw</td>
								<td>Sk Pengangkatan</td>
								<td>Tgl Lahir</td>
								<td>Tmp Lahir</td>
								<td>Tmt Pengangkatan</td>
								
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->alamat }}</td>
									<td>{{ $item->bujur }}</td>
									<td>{{ $item->dusun }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->gelar_belakang }}</td>
									<td>{{ $item->gelar_depan }}</td>
									<td>{{ $item->id_agama }}</td>
									<td>{{ $item->id_desa }}</td>
									<td>{{ $item->id_disabilitas }}</td>
									<td>{{ $item->id_jenis_kelamin }}</td>
									<td>{{ $item->id_pekerjaan_pasangan }}</td>
									<td>{{ $item->id_sekolah }}</td>
									<td>{{ $item->id_status_kepegawaian }}</td>
									<td>{{ $item->id_status_perkawinan }}</td>
									<td>{{ $item->kode_pos }}</td>
									<td>{{ $item->lintang }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->nama_ibu_kandung }}</td>
									<td>{{ $item->nama_pasangan }}</td>
									<td>{{ $item->nik }}</td>
									<td>{{ $item->nip }}</td>
									<td>{{ $item->no_hp }}</td>
									<td>{{ $item->no_kk }}</td>
									<td>{{ $item->npwp }}</td>
									<td>{{ $item->nuptk }}</td>
									<td>{{ $item->rt }}</td>
									<td>{{ $item->rw }}</td>
									<td>{{ $item->sk_pengangkatan }}</td>
									<td>{{ $item->tgl_lahir }}</td>
									<td>{{ $item->tmp_lahir }}</td>
									<td>{{ $item->tmt_pengangkatan }}</td>
									
                                    <td>
										{!! button('guru.show','', $item->id) !!}
										{!! button('guru.edit', $title, $item->id) !!}
                                        {!! button('guru.destroy', $title, $item->id) !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="33" class="text-center"><i>No data.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
				{{ $data->links() }}
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection