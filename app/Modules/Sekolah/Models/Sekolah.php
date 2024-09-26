<?php

namespace App\Modules\Sekolah\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\JenisSekolah\Models\JenisSekolah;
use App\Modules\StatusSekolah\Models\StatusSekolah;
use App\Modules\Desa\Models\Desa;


class Sekolah extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'sekolah';
	protected $fillable   = ['*'];	

	public function jenisSekolah(){
		return $this->belongsTo(JenisSekolah::class,"id_jenis_sekolah","id");
	}
public function statusSekolah(){
		return $this->belongsTo(StatusSekolah::class,"id_status_sekolah","id");
	}
public function desa(){
		return $this->belongsTo(Desa::class,"id_desa","id");
	}

}
