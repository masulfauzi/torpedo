<?php

namespace App\Modules\Siswa\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Agama\Models\Agama;
use App\Modules\AlasanPip\Models\AlasanPip;
use App\Modules\AlasanTolakKip\Models\AlasanTolakKip;
use App\Modules\Desa\Models\Desa;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\JenisKelamin\Models\JenisKelamin;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\TempatTinggal\Models\TempatTinggal;
use App\Modules\Transportasi\Models\Transportasi;


class Siswa extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'siswa';
	protected $fillable   = ['*'];	

	public function agama(){
		return $this->belongsTo(Agama::class,"id_agama","id");
	}
public function alasanPip(){
		return $this->belongsTo(AlasanPip::class,"id_alasan_pip","id");
	}
public function alasanTolakKip(){
		return $this->belongsTo(AlasanTolakKip::class,"id_alasan_tolak_kip","id");
	}
public function desa(){
		return $this->belongsTo(Desa::class,"id_desa","id");
	}
public function disabilitas(){
		return $this->belongsTo(Disabilitas::class,"id_disabilitas","id");
	}
public function jenisKelamin(){
		return $this->belongsTo(JenisKelamin::class,"id_jenis_kelamin","id");
	}
public function sekolah(){
		return $this->belongsTo(Sekolah::class,"id_sekolah","id");
	}
public function tempatTinggal(){
		return $this->belongsTo(TempatTinggal::class,"id_tempat_tinggal","id");
	}
public function transportasi(){
		return $this->belongsTo(Transportasi::class,"id_transportasi","id");
	}

}
