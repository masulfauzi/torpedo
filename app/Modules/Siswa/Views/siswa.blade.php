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
                        <form action="{{ route('siswa.index') }}" method="get">
                            <div class="form-group col-md-3 has-icon-left position-relative">
                                <input type="text" class="form-control" value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                <div class="form-control-icon"><i class="fa fa-search"></i></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">  
						{!! button('siswa.create', $title) !!}  
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>Alamat</td>
								<td>Asal Sekolah</td>
								<td>Bujur</td>
								<td>Dusun</td>
								<td>Email</td>
								<td>Agama</td>
								<td>Alasan Pip</td>
								<td>Alasan Tolak Kip</td>
								<td>Desa</td>
								<td>Disabilitas</td>
								<td>Jenis Kelamin</td>
								<td>Sekolah</td>
								<td>Tempat Tinggal</td>
								<td>Transportasi</td>
								<td>Is Kip</td>
								<td>Is Kps</td>
								<td>Is Pip</td>
								<td>Kode Pos</td>
								<td>Lintang</td>
								<td>Nama Di Kip</td>
								<td>Nama Siswa</td>
								<td>Nik</td>
								<td>Nis</td>
								<td>Nisn</td>
								<td>No Akta Lahir</td>
								<td>No Hp</td>
								<td>No Ijazah Smp</td>
								<td>No Kip</td>
								<td>No Kks</td>
								<td>No Kps</td>
								<td>No Skhun Smp</td>
								<td>No Telp</td>
								<td>No Un Smp</td>
								<td>Npsn Smp</td>
								<td>Rt</td>
								<td>Rw</td>
								<td>Tgl Lahir</td>
								<td>Tgl Masuk</td>
								<td>Tmp Lahir</td>
								
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->alamat }}</td>
									<td>{{ $item->asal_sekolah }}</td>
									<td>{{ $item->bujur }}</td>
									<td>{{ $item->dusun }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->id_agama }}</td>
									<td>{{ $item->id_alasan_pip }}</td>
									<td>{{ $item->id_alasan_tolak_kip }}</td>
									<td>{{ $item->id_desa }}</td>
									<td>{{ $item->id_disabilitas }}</td>
									<td>{{ $item->id_jenis_kelamin }}</td>
									<td>{{ $item->id_sekolah }}</td>
									<td>{{ $item->id_tempat_tinggal }}</td>
									<td>{{ $item->id_transportasi }}</td>
									<td>{{ $item->is_kip }}</td>
									<td>{{ $item->is_kps }}</td>
									<td>{{ $item->is_pip }}</td>
									<td>{{ $item->kode_pos }}</td>
									<td>{{ $item->lintang }}</td>
									<td>{{ $item->nama_di_kip }}</td>
									<td>{{ $item->nama_siswa }}</td>
									<td>{{ $item->nik }}</td>
									<td>{{ $item->nis }}</td>
									<td>{{ $item->nisn }}</td>
									<td>{{ $item->no_akta_lahir }}</td>
									<td>{{ $item->no_hp }}</td>
									<td>{{ $item->no_ijazah_smp }}</td>
									<td>{{ $item->no_kip }}</td>
									<td>{{ $item->no_kks }}</td>
									<td>{{ $item->no_kps }}</td>
									<td>{{ $item->no_skhun_smp }}</td>
									<td>{{ $item->no_telp }}</td>
									<td>{{ $item->no_un_smp }}</td>
									<td>{{ $item->npsn_smp }}</td>
									<td>{{ $item->rt }}</td>
									<td>{{ $item->rw }}</td>
									<td>{{ $item->tgl_lahir }}</td>
									<td>{{ $item->tgl_masuk }}</td>
									<td>{{ $item->tmp_lahir }}</td>
									
                                    <td>
										{!! button('siswa.show','', $item->id) !!}
										{!! button('siswa.edit', $title, $item->id) !!}
                                        {!! button('siswa.destroy', $title, $item->id) !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="41" class="text-center"><i>No data.</i></td>
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