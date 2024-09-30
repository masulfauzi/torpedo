<?php

namespace App\Modules\JurnalMengajar\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Jadwal\Models\Jadwal;


class JurnalMengajar extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'jurnal_mengajar';
	protected $fillable   = ['*'];	

	public function jadwal(){
		return $this->belongsTo(Jadwal::class,"id_jadwal","id");
	}

}
