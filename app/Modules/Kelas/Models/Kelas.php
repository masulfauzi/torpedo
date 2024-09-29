<?php

namespace App\Modules\Kelas\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\Jurusan\Models\Jurusan;


class Kelas extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'kelas';
	protected $fillable   = ['*'];	

	public function sekolah(){
		return $this->belongsTo(Sekolah::class,"id_sekolah","id");
	}
public function jurusan(){
		return $this->belongsTo(Jurusan::class,"id_jurusan","id");
	}

}
