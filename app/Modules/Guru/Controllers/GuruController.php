<?php
namespace App\Modules\Guru\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Guru\Models\Guru;
use App\Modules\Agama\Models\Agama;
use App\Modules\Desa\Models\Desa;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\JenisKelamin\Models\JenisKelamin;
use App\Modules\Pekerjaan\Models\Pekerjaan;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\StatusKepegawaian\Models\StatusKepegawaian;
use App\Modules\StatusPerkawinan\Models\StatusPerkawinan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Guru";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Guru::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Guru::guru', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_agama = Agama::all()->pluck('created_at','id');
		$ref_desa = Desa::all()->pluck('created_by','id');
		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_jenis_kelamin = JenisKelamin::all()->pluck('created_by','id');
		$ref_pekerjaan = Pekerjaan::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_status_kepegawaian = StatusKepegawaian::all()->pluck('created_by','id');
		$ref_status_perkawinan = StatusPerkawinan::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'alamat' => ['Alamat', Form::textarea("alamat", old("alamat"), ["class" => "form-control rich-editor"]) ],
			'bujur' => ['Bujur', Form::text("bujur", old("bujur"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'dusun' => ['Dusun', Form::text("dusun", old("dusun"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'email' => ['Email', Form::text("email", old("email"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'gelar_belakang' => ['Gelar Belakang', Form::text("gelar_belakang", old("gelar_belakang"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'gelar_depan' => ['Gelar Depan', Form::text("gelar_depan", old("gelar_depan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'id_agama' => ['Agama', Form::select("id_agama", $ref_agama, null, ["class" => "form-control select2"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_jenis_kelamin' => ['Jenis Kelamin', Form::select("id_jenis_kelamin", $ref_jenis_kelamin, null, ["class" => "form-control select2"]) ],
			'id_pekerjaan_pasangan' => ['Pekerjaan Pasangan', Form::select("id_pekerjaan_pasangan", $ref_pekerjaan, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_status_kepegawaian' => ['Status Kepegawaian', Form::select("id_status_kepegawaian", $ref_status_kepegawaian, null, ["class" => "form-control select2"]) ],
			'id_status_perkawinan' => ['Status Perkawinan', Form::select("id_status_perkawinan", $ref_status_perkawinan, null, ["class" => "form-control select2"]) ],
			'kode_pos' => ['Kode Pos', Form::text("kode_pos", old("kode_pos"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'lintang' => ['Lintang', Form::text("lintang", old("lintang"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nama' => ['Nama', Form::text("nama", old("nama"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nama_ibu_kandung' => ['Nama Ibu Kandung', Form::text("nama_ibu_kandung", old("nama_ibu_kandung"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nama_pasangan' => ['Nama Pasangan', Form::text("nama_pasangan", old("nama_pasangan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nik' => ['Nik', Form::text("nik", old("nik"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nip' => ['Nip', Form::text("nip", old("nip"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_hp' => ['No Hp', Form::text("no_hp", old("no_hp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_kk' => ['No Kk', Form::text("no_kk", old("no_kk"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'npwp' => ['Npwp', Form::text("npwp", old("npwp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nuptk' => ['Nuptk', Form::text("nuptk", old("nuptk"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'rt' => ['Rt', Form::text("rt", old("rt"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'rw' => ['Rw', Form::text("rw", old("rw"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'sk_pengangkatan' => ['Sk Pengangkatan', Form::text("sk_pengangkatan", old("sk_pengangkatan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", old("tgl_lahir"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", old("tmp_lahir"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'tmt_pengangkatan' => ['Tmt Pengangkatan', Form::text("tmt_pengangkatan", old("tmt_pengangkatan"), ["class" => "form-control datepicker", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Guru::guru_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'alamat' => 'required',
			'bujur' => 'required',
			'dusun' => 'required',
			'email' => 'required',
			'gelar_belakang' => 'required',
			'gelar_depan' => 'required',
			'id_agama' => 'required',
			'id_desa' => 'required',
			'id_disabilitas' => 'required',
			'id_jenis_kelamin' => 'required',
			'id_pekerjaan_pasangan' => 'required',
			'id_sekolah' => 'required',
			'id_status_kepegawaian' => 'required',
			'id_status_perkawinan' => 'required',
			'kode_pos' => 'required',
			'lintang' => 'required',
			'nama' => 'required',
			'nama_ibu_kandung' => 'required',
			'nama_pasangan' => 'required',
			'nik' => 'required',
			'nip' => 'required',
			'no_hp' => 'required',
			'no_kk' => 'required',
			'npwp' => 'required',
			'nuptk' => 'required',
			'rt' => 'required',
			'rw' => 'required',
			'sk_pengangkatan' => 'required',
			'tgl_lahir' => 'required',
			'tmp_lahir' => 'required',
			'tmt_pengangkatan' => 'required',
			
		]);

		$guru = new Guru();
		$guru->alamat = $request->input("alamat");
		$guru->bujur = $request->input("bujur");
		$guru->dusun = $request->input("dusun");
		$guru->email = $request->input("email");
		$guru->gelar_belakang = $request->input("gelar_belakang");
		$guru->gelar_depan = $request->input("gelar_depan");
		$guru->id_agama = $request->input("id_agama");
		$guru->id_desa = $request->input("id_desa");
		$guru->id_disabilitas = $request->input("id_disabilitas");
		$guru->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$guru->id_pekerjaan_pasangan = $request->input("id_pekerjaan_pasangan");
		$guru->id_sekolah = $request->input("id_sekolah");
		$guru->id_status_kepegawaian = $request->input("id_status_kepegawaian");
		$guru->id_status_perkawinan = $request->input("id_status_perkawinan");
		$guru->kode_pos = $request->input("kode_pos");
		$guru->lintang = $request->input("lintang");
		$guru->nama = $request->input("nama");
		$guru->nama_ibu_kandung = $request->input("nama_ibu_kandung");
		$guru->nama_pasangan = $request->input("nama_pasangan");
		$guru->nik = $request->input("nik");
		$guru->nip = $request->input("nip");
		$guru->no_hp = $request->input("no_hp");
		$guru->no_kk = $request->input("no_kk");
		$guru->npwp = $request->input("npwp");
		$guru->nuptk = $request->input("nuptk");
		$guru->rt = $request->input("rt");
		$guru->rw = $request->input("rw");
		$guru->sk_pengangkatan = $request->input("sk_pengangkatan");
		$guru->tgl_lahir = $request->input("tgl_lahir");
		$guru->tmp_lahir = $request->input("tmp_lahir");
		$guru->tmt_pengangkatan = $request->input("tmt_pengangkatan");
		
		$guru->created_by = Auth::id();
		$guru->save();

		$text = 'membuat '.$this->title; //' baru '.$guru->what;
		$this->log($request, $text, ['guru.id' => $guru->id]);
		return redirect()->route('guru.index')->with('message_success', 'Guru berhasil ditambahkan!');
	}

	public function show(Request $request, Guru $guru)
	{
		$data['guru'] = $guru;

		$text = 'melihat detail '.$this->title;//.' '.$guru->what;
		$this->log($request, $text, ['guru.id' => $guru->id]);
		return view('Guru::guru_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Guru $guru)
	{
		$data['guru'] = $guru;

		$ref_agama = Agama::all()->pluck('created_at','id');
		$ref_desa = Desa::all()->pluck('created_by','id');
		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_jenis_kelamin = JenisKelamin::all()->pluck('created_by','id');
		$ref_pekerjaan = Pekerjaan::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_status_kepegawaian = StatusKepegawaian::all()->pluck('created_by','id');
		$ref_status_perkawinan = StatusPerkawinan::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'alamat' => ['Alamat', Form::textarea("alamat", $guru->alamat, ["class" => "form-control rich-editor"]) ],
			'bujur' => ['Bujur', Form::text("bujur", $guru->bujur, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "bujur"]) ],
			'dusun' => ['Dusun', Form::text("dusun", $guru->dusun, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "dusun"]) ],
			'email' => ['Email', Form::text("email", $guru->email, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "email"]) ],
			'gelar_belakang' => ['Gelar Belakang', Form::text("gelar_belakang", $guru->gelar_belakang, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "gelar_belakang"]) ],
			'gelar_depan' => ['Gelar Depan', Form::text("gelar_depan", $guru->gelar_depan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "gelar_depan"]) ],
			'id_agama' => ['Agama', Form::select("id_agama", $ref_agama, null, ["class" => "form-control select2"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_jenis_kelamin' => ['Jenis Kelamin', Form::select("id_jenis_kelamin", $ref_jenis_kelamin, null, ["class" => "form-control select2"]) ],
			'id_pekerjaan_pasangan' => ['Pekerjaan Pasangan', Form::select("id_pekerjaan_pasangan", $ref_pekerjaan, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_status_kepegawaian' => ['Status Kepegawaian', Form::select("id_status_kepegawaian", $ref_status_kepegawaian, null, ["class" => "form-control select2"]) ],
			'id_status_perkawinan' => ['Status Perkawinan', Form::select("id_status_perkawinan", $ref_status_perkawinan, null, ["class" => "form-control select2"]) ],
			'kode_pos' => ['Kode Pos', Form::text("kode_pos", $guru->kode_pos, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "kode_pos"]) ],
			'lintang' => ['Lintang', Form::text("lintang", $guru->lintang, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "lintang"]) ],
			'nama' => ['Nama', Form::text("nama", $guru->nama, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama"]) ],
			'nama_ibu_kandung' => ['Nama Ibu Kandung', Form::text("nama_ibu_kandung", $guru->nama_ibu_kandung, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_ibu_kandung"]) ],
			'nama_pasangan' => ['Nama Pasangan', Form::text("nama_pasangan", $guru->nama_pasangan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_pasangan"]) ],
			'nik' => ['Nik', Form::text("nik", $guru->nik, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nik"]) ],
			'nip' => ['Nip', Form::text("nip", $guru->nip, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nip"]) ],
			'no_hp' => ['No Hp', Form::text("no_hp", $guru->no_hp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_hp"]) ],
			'no_kk' => ['No Kk', Form::text("no_kk", $guru->no_kk, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_kk"]) ],
			'npwp' => ['Npwp', Form::text("npwp", $guru->npwp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "npwp"]) ],
			'nuptk' => ['Nuptk', Form::text("nuptk", $guru->nuptk, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nuptk"]) ],
			'rt' => ['Rt', Form::text("rt", $guru->rt, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "rt"]) ],
			'rw' => ['Rw', Form::text("rw", $guru->rw, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "rw"]) ],
			'sk_pengangkatan' => ['Sk Pengangkatan', Form::text("sk_pengangkatan", $guru->sk_pengangkatan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "sk_pengangkatan"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", $guru->tgl_lahir, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_lahir"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", $guru->tmp_lahir, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "tmp_lahir"]) ],
			'tmt_pengangkatan' => ['Tmt Pengangkatan', Form::text("tmt_pengangkatan", $guru->tmt_pengangkatan, ["class" => "form-control datepicker", "required" => "required", "id" => "tmt_pengangkatan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$guru->what;
		$this->log($request, $text, ['guru.id' => $guru->id]);
		return view('Guru::guru_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'alamat' => 'required',
			'bujur' => 'required',
			'dusun' => 'required',
			'email' => 'required',
			'gelar_belakang' => 'required',
			'gelar_depan' => 'required',
			'id_agama' => 'required',
			'id_desa' => 'required',
			'id_disabilitas' => 'required',
			'id_jenis_kelamin' => 'required',
			'id_pekerjaan_pasangan' => 'required',
			'id_sekolah' => 'required',
			'id_status_kepegawaian' => 'required',
			'id_status_perkawinan' => 'required',
			'kode_pos' => 'required',
			'lintang' => 'required',
			'nama' => 'required',
			'nama_ibu_kandung' => 'required',
			'nama_pasangan' => 'required',
			'nik' => 'required',
			'nip' => 'required',
			'no_hp' => 'required',
			'no_kk' => 'required',
			'npwp' => 'required',
			'nuptk' => 'required',
			'rt' => 'required',
			'rw' => 'required',
			'sk_pengangkatan' => 'required',
			'tgl_lahir' => 'required',
			'tmp_lahir' => 'required',
			'tmt_pengangkatan' => 'required',
			
		]);
		
		$guru = Guru::find($id);
		$guru->alamat = $request->input("alamat");
		$guru->bujur = $request->input("bujur");
		$guru->dusun = $request->input("dusun");
		$guru->email = $request->input("email");
		$guru->gelar_belakang = $request->input("gelar_belakang");
		$guru->gelar_depan = $request->input("gelar_depan");
		$guru->id_agama = $request->input("id_agama");
		$guru->id_desa = $request->input("id_desa");
		$guru->id_disabilitas = $request->input("id_disabilitas");
		$guru->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$guru->id_pekerjaan_pasangan = $request->input("id_pekerjaan_pasangan");
		$guru->id_sekolah = $request->input("id_sekolah");
		$guru->id_status_kepegawaian = $request->input("id_status_kepegawaian");
		$guru->id_status_perkawinan = $request->input("id_status_perkawinan");
		$guru->kode_pos = $request->input("kode_pos");
		$guru->lintang = $request->input("lintang");
		$guru->nama = $request->input("nama");
		$guru->nama_ibu_kandung = $request->input("nama_ibu_kandung");
		$guru->nama_pasangan = $request->input("nama_pasangan");
		$guru->nik = $request->input("nik");
		$guru->nip = $request->input("nip");
		$guru->no_hp = $request->input("no_hp");
		$guru->no_kk = $request->input("no_kk");
		$guru->npwp = $request->input("npwp");
		$guru->nuptk = $request->input("nuptk");
		$guru->rt = $request->input("rt");
		$guru->rw = $request->input("rw");
		$guru->sk_pengangkatan = $request->input("sk_pengangkatan");
		$guru->tgl_lahir = $request->input("tgl_lahir");
		$guru->tmp_lahir = $request->input("tmp_lahir");
		$guru->tmt_pengangkatan = $request->input("tmt_pengangkatan");
		
		$guru->updated_by = Auth::id();
		$guru->save();


		$text = 'mengedit '.$this->title;//.' '.$guru->what;
		$this->log($request, $text, ['guru.id' => $guru->id]);
		return redirect()->route('guru.index')->with('message_success', 'Guru berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$guru = Guru::find($id);
		$guru->deleted_by = Auth::id();
		$guru->save();
		$guru->delete();

		$text = 'menghapus '.$this->title;//.' '.$guru->what;
		$this->log($request, $text, ['guru.id' => $guru->id]);
		return back()->with('message_success', 'Guru berhasil dihapus!');
	}

}
