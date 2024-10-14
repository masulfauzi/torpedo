<?php

namespace App\Modules\Sekolah\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\JenisSekolah\Models\JenisSekolah;
use App\Modules\StatusSekolah\Models\StatusSekolah;
use App\Modules\Desa\Models\Desa;
use App\Modules\Role\Models\Role;
use App\Modules\UserRole\Models\UserRole;

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

	public static function insert_sekolah($request)
	{
		// dd($request);

		// return Sekolah::create([
		// 	'id_jenis_sekolah' => $request->input('id_jenis_sekolah'),
        //     'id_status_sekolah' => $request->input('id_status_sekolah'),
        //     'nama_sekolah' => $request->input('nama_sekolah'),
        //     'npsn' => $request->input('npsn')
		// ]);
		$id = Sekolah::gen_uuid();

		 DB::table('sekolah')
					->insert([
							'id' => $id,
							'id_jenis_sekolah' => $request->input('id_jenis_sekolah'),
						    'id_status_sekolah' => $request->input('id_status_sekolah'),
						    'nama_sekolah' => $request->input('nama_sekolah'),
						    'npsn' => $request->input('npsn')
						]);

						return $id;
	}

	public static function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	
			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),
	
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,
	
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,
	
			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}

	public static function insert_role($user)
	{
		$role = Role::whereRole('Operator Sekolah')->first();

		DB::table('user_role')
			->insert([
				'id' => Sekolah::gen_uuid(),
				'id_user'	=> $user->id,
				'id_role'	=> $role->id
			]);

	}

	public static function kirim_notif_wa($no_hp)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'appkey' => '53550f4f-0e39-43e5-84be-fb053e189b44',
				'authkey' => 'rdq8556tEh4EMWRVGSNczMCzoh3P4f8inUK30qmXAN3WvwNN3N',
				'to' => $no_hp,
				'message' => 'Terimakasih telah melakukan registrasi di Torpedo Corp. Siahkan lengkapidata-data untuk melanjutkan.',
				'sandbox' => 'false'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}

}
