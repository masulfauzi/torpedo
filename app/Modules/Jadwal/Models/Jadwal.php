<?php

namespace App\Modules\Jadwal\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Guru\Models\Guru;
use App\Modules\Hari\Models\Hari;
use App\Modules\JamMulai\Models\JamMulai;
use App\Modules\JamSelesai\Models\JamSelesai;
use App\Modules\Mapel\Models\Mapel;
use App\Modules\Ruang\Models\Ruang;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\Semester\Models\Semester;
use App\Modules\VersiJadwal\Models\VersiJadwal;


class Jadwal extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'jadwal';
	protected $fillable   = ['*'];	

	public function guru(){
		return $this->belongsTo(Guru::class,"id_guru","id");
	}
public function hari(){
		return $this->belongsTo(Hari::class,"id_hari","id");
	}
public function jamMulai(){
		return $this->belongsTo(JamMulai::class,"id_jam_mulai","id");
	}
public function jamSelesai(){
		return $this->belongsTo(JamSelesai::class,"id_jam_selesai","id");
	}
public function mapel(){
		return $this->belongsTo(Mapel::class,"id_mapel","id");
	}
public function ruang(){
		return $this->belongsTo(Ruang::class,"id_ruang","id");
	}
public function sekolah(){
		return $this->belongsTo(Sekolah::class,"id_sekolah","id");
	}
public function semester(){
		return $this->belongsTo(Semester::class,"id_semester","id");
	}
public function versiJadwal(){
		return $this->belongsTo(VersiJadwal::class,"id_versi_jadwal","id");
	}

}
