<?php

namespace App\Modules\AnggotaKelas\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Siswa\Models\Siswa;
use App\Modules\Kelas\Models\Kelas;
use App\Modules\Semester\Models\Semester;


class AnggotaKelas extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'anggota_kelas';
	protected $fillable   = ['*'];	

	public function siswa(){
		return $this->belongsTo(Siswa::class,"id_siswa","id");
	}
public function kelas(){
		return $this->belongsTo(Kelas::class,"id_kelas","id");
	}
public function semester(){
		return $this->belongsTo(Semester::class,"id_semester","id");
	}

}
