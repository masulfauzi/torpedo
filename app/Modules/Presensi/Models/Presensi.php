<?php

namespace App\Modules\Presensi\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\AnggotaKelas\Models\AnggotaKelas;
use App\Modules\StatusKehadiran\Models\StatusKehadiran;


class Presensi extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'presensi';
	protected $fillable   = ['*'];	

	public function anggotaKelas(){
		return $this->belongsTo(AnggotaKelas::class,"id_anggota_kelas","id");
	}
public function statusKehadiran(){
		return $this->belongsTo(StatusKehadiran::class,"id_status_kehadiran","id");
	}

}
