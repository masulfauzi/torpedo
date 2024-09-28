<?php

namespace App\Modules\Guru\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Agama\Models\Agama;
use App\Modules\Desa\Models\Desa;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\JenisKelamin\Models\JenisKelamin;
use App\Modules\PekerjaanPasangan\Models\PekerjaanPasangan;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\StatusKepegawaian\Models\StatusKepegawaian;
use App\Modules\StatusPerkawinan\Models\StatusPerkawinan;


class Guru extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'guru';
	protected $fillable   = ['*'];	

	public function agama(){
		return $this->belongsTo(Agama::class,"id_agama","id");
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
public function pekerjaanPasangan(){
		return $this->belongsTo(PekerjaanPasangan::class,"id_pekerjaan_pasangan","id");
	}
public function sekolah(){
		return $this->belongsTo(Sekolah::class,"id_sekolah","id");
	}
public function statusKepegawaian(){
		return $this->belongsTo(StatusKepegawaian::class,"id_status_kepegawaian","id");
	}
public function statusPerkawinan(){
		return $this->belongsTo(StatusPerkawinan::class,"id_status_perkawinan","id");
	}

}
