<?php

namespace App\Modules\Keluarga\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\HubKeluarga\Models\HubKeluarga;
use App\Modules\Pekerjaan\Models\Pekerjaan;
use App\Modules\Pendidikan\Models\Pendidikan;
use App\Modules\Penghasilan\Models\Penghasilan;
use App\Modules\Siswa\Models\Siswa;


class Keluarga extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'keluarga';
	protected $fillable   = ['*'];	

	public function disabilitas(){
		return $this->belongsTo(Disabilitas::class,"id_disabilitas","id");
	}
public function hubKeluarga(){
		return $this->belongsTo(HubKeluarga::class,"id_hub_keluarga","id");
	}
public function pekerjaan(){
		return $this->belongsTo(Pekerjaan::class,"id_pekerjaan","id");
	}
public function pendidikan(){
		return $this->belongsTo(Pendidikan::class,"id_pendidikan","id");
	}
public function penghasilan(){
		return $this->belongsTo(Penghasilan::class,"id_penghasilan","id");
	}
public function siswa(){
		return $this->belongsTo(Siswa::class,"id_siswa","id");
	}

}
