<?php

namespace App\Modules\Files\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Jenis\Models\Jenis;


class Files extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'files';
	protected $fillable   = ['*'];	

	public function jenis(){
		return $this->belongsTo(Jenis::class,"id_jenis","id");
	}

}
