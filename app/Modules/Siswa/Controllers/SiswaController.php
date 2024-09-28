<?php
namespace App\Modules\Siswa\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Siswa\Models\Siswa;
use App\Modules\Agama\Models\Agama;
use App\Modules\AlasanPip\Models\AlasanPip;
use App\Modules\AlasanTolakKip\Models\AlasanTolakKip;
use App\Modules\Desa\Models\Desa;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\JenisKelamin\Models\JenisKelamin;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\TempatTinggal\Models\TempatTinggal;
use App\Modules\Transportasi\Models\Transportasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Siswa";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Siswa::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Siswa::siswa', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_agama = Agama::all()->pluck('created_at','id');
		$ref_alasan_pip = AlasanPip::all()->pluck('created_at','id');
		$ref_alasan_tolak_kip = AlasanTolakKip::all()->pluck('created_at','id');
		$ref_desa = Desa::all()->pluck('created_by','id');
		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_jenis_kelamin = JenisKelamin::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_tempat_tinggal = TempatTinggal::all()->pluck('created_by','id');
		$ref_transportasi = Transportasi::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'alamat' => ['Alamat', Form::textarea("alamat", old("alamat"), ["class" => "form-control rich-editor"]) ],
			'asal_sekolah' => ['Asal Sekolah', Form::text("asal_sekolah", old("asal_sekolah"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'bujur' => ['Bujur', Form::text("bujur", old("bujur"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'dusun' => ['Dusun', Form::text("dusun", old("dusun"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'email' => ['Email', Form::text("email", old("email"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'id_agama' => ['Agama', Form::select("id_agama", $ref_agama, null, ["class" => "form-control select2"]) ],
			'id_alasan_pip' => ['Alasan Pip', Form::select("id_alasan_pip", $ref_alasan_pip, null, ["class" => "form-control select2"]) ],
			'id_alasan_tolak_kip' => ['Alasan Tolak Kip', Form::select("id_alasan_tolak_kip", $ref_alasan_tolak_kip, null, ["class" => "form-control select2"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_jenis_kelamin' => ['Jenis Kelamin', Form::select("id_jenis_kelamin", $ref_jenis_kelamin, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_tempat_tinggal' => ['Tempat Tinggal', Form::select("id_tempat_tinggal", $ref_tempat_tinggal, null, ["class" => "form-control select2"]) ],
			'id_transportasi' => ['Transportasi', Form::select("id_transportasi", $ref_transportasi, null, ["class" => "form-control select2"]) ],
			'is_kip' => ['Is Kip', Form::select("is_kip", ["1" => "Ya", "0" => "Tidak"], old("is_kip"), ["class" => "form-control", "required" => "required"]) ],
			'is_kps' => ['Is Kps', Form::select("is_kps", ["1" => "Ya", "0" => "Tidak"], old("is_kps"), ["class" => "form-control", "required" => "required"]) ],
			'is_pip' => ['Is Pip', Form::select("is_pip", ["1" => "Ya", "0" => "Tidak"], old("is_pip"), ["class" => "form-control", "required" => "required"]) ],
			'kode_pos' => ['Kode Pos', Form::text("kode_pos", old("kode_pos"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'lintang' => ['Lintang', Form::text("lintang", old("lintang"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nama_di_kip' => ['Nama Di Kip', Form::text("nama_di_kip", old("nama_di_kip"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nama_siswa' => ['Nama Siswa', Form::text("nama_siswa", old("nama_siswa"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nik' => ['Nik', Form::text("nik", old("nik"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nis' => ['Nis', Form::text("nis", old("nis"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nisn' => ['Nisn', Form::text("nisn", old("nisn"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_akta_lahir' => ['No Akta Lahir', Form::text("no_akta_lahir", old("no_akta_lahir"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_hp' => ['No Hp', Form::text("no_hp", old("no_hp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_ijazah_smp' => ['No Ijazah Smp', Form::text("no_ijazah_smp", old("no_ijazah_smp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_kip' => ['No Kip', Form::text("no_kip", old("no_kip"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_kks' => ['No Kks', Form::text("no_kks", old("no_kks"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_kps' => ['No Kps', Form::text("no_kps", old("no_kps"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_skhun_smp' => ['No Skhun Smp', Form::text("no_skhun_smp", old("no_skhun_smp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_telp' => ['No Telp', Form::text("no_telp", old("no_telp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'no_un_smp' => ['No Un Smp', Form::text("no_un_smp", old("no_un_smp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'npsn_smp' => ['Npsn Smp', Form::text("npsn_smp", old("npsn_smp"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'rt' => ['Rt', Form::text("rt", old("rt"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'rw' => ['Rw', Form::text("rw", old("rw"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", old("tgl_lahir"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'tgl_masuk' => ['Tgl Masuk', Form::text("tgl_masuk", old("tgl_masuk"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", old("tmp_lahir"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Siswa::siswa_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'alamat' => 'required',
			'asal_sekolah' => 'required',
			'bujur' => 'required',
			'dusun' => 'required',
			'email' => 'required',
			'id_agama' => 'required',
			'id_alasan_pip' => 'required',
			'id_alasan_tolak_kip' => 'required',
			'id_desa' => 'required',
			'id_disabilitas' => 'required',
			'id_jenis_kelamin' => 'required',
			'id_sekolah' => 'required',
			'id_tempat_tinggal' => 'required',
			'id_transportasi' => 'required',
			'is_kip' => 'required',
			'is_kps' => 'required',
			'is_pip' => 'required',
			'kode_pos' => 'required',
			'lintang' => 'required',
			'nama_di_kip' => 'required',
			'nama_siswa' => 'required',
			'nik' => 'required',
			'nis' => 'required',
			'nisn' => 'required',
			'no_akta_lahir' => 'required',
			'no_hp' => 'required',
			'no_ijazah_smp' => 'required',
			'no_kip' => 'required',
			'no_kks' => 'required',
			'no_kps' => 'required',
			'no_skhun_smp' => 'required',
			'no_telp' => 'required',
			'no_un_smp' => 'required',
			'npsn_smp' => 'required',
			'rt' => 'required',
			'rw' => 'required',
			'tgl_lahir' => 'required',
			'tgl_masuk' => 'required',
			'tmp_lahir' => 'required',
			
		]);

		$siswa = new Siswa();
		$siswa->alamat = $request->input("alamat");
		$siswa->asal_sekolah = $request->input("asal_sekolah");
		$siswa->bujur = $request->input("bujur");
		$siswa->dusun = $request->input("dusun");
		$siswa->email = $request->input("email");
		$siswa->id_agama = $request->input("id_agama");
		$siswa->id_alasan_pip = $request->input("id_alasan_pip");
		$siswa->id_alasan_tolak_kip = $request->input("id_alasan_tolak_kip");
		$siswa->id_desa = $request->input("id_desa");
		$siswa->id_disabilitas = $request->input("id_disabilitas");
		$siswa->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$siswa->id_sekolah = $request->input("id_sekolah");
		$siswa->id_tempat_tinggal = $request->input("id_tempat_tinggal");
		$siswa->id_transportasi = $request->input("id_transportasi");
		$siswa->is_kip = $request->input("is_kip");
		$siswa->is_kps = $request->input("is_kps");
		$siswa->is_pip = $request->input("is_pip");
		$siswa->kode_pos = $request->input("kode_pos");
		$siswa->lintang = $request->input("lintang");
		$siswa->nama_di_kip = $request->input("nama_di_kip");
		$siswa->nama_siswa = $request->input("nama_siswa");
		$siswa->nik = $request->input("nik");
		$siswa->nis = $request->input("nis");
		$siswa->nisn = $request->input("nisn");
		$siswa->no_akta_lahir = $request->input("no_akta_lahir");
		$siswa->no_hp = $request->input("no_hp");
		$siswa->no_ijazah_smp = $request->input("no_ijazah_smp");
		$siswa->no_kip = $request->input("no_kip");
		$siswa->no_kks = $request->input("no_kks");
		$siswa->no_kps = $request->input("no_kps");
		$siswa->no_skhun_smp = $request->input("no_skhun_smp");
		$siswa->no_telp = $request->input("no_telp");
		$siswa->no_un_smp = $request->input("no_un_smp");
		$siswa->npsn_smp = $request->input("npsn_smp");
		$siswa->rt = $request->input("rt");
		$siswa->rw = $request->input("rw");
		$siswa->tgl_lahir = $request->input("tgl_lahir");
		$siswa->tgl_masuk = $request->input("tgl_masuk");
		$siswa->tmp_lahir = $request->input("tmp_lahir");
		
		$siswa->created_by = Auth::id();
		$siswa->save();

		$text = 'membuat '.$this->title; //' baru '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return redirect()->route('siswa.index')->with('message_success', 'Siswa berhasil ditambahkan!');
	}

	public function show(Request $request, Siswa $siswa)
	{
		$data['siswa'] = $siswa;

		$text = 'melihat detail '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return view('Siswa::siswa_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Siswa $siswa)
	{
		$data['siswa'] = $siswa;

		$ref_agama = Agama::all()->pluck('created_at','id');
		$ref_alasan_pip = AlasanPip::all()->pluck('created_at','id');
		$ref_alasan_tolak_kip = AlasanTolakKip::all()->pluck('created_at','id');
		$ref_desa = Desa::all()->pluck('created_by','id');
		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_jenis_kelamin = JenisKelamin::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_tempat_tinggal = TempatTinggal::all()->pluck('created_by','id');
		$ref_transportasi = Transportasi::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'alamat' => ['Alamat', Form::textarea("alamat", $siswa->alamat, ["class" => "form-control rich-editor"]) ],
			'asal_sekolah' => ['Asal Sekolah', Form::text("asal_sekolah", $siswa->asal_sekolah, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "asal_sekolah"]) ],
			'bujur' => ['Bujur', Form::text("bujur", $siswa->bujur, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "bujur"]) ],
			'dusun' => ['Dusun', Form::text("dusun", $siswa->dusun, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "dusun"]) ],
			'email' => ['Email', Form::text("email", $siswa->email, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "email"]) ],
			'id_agama' => ['Agama', Form::select("id_agama", $ref_agama, null, ["class" => "form-control select2"]) ],
			'id_alasan_pip' => ['Alasan Pip', Form::select("id_alasan_pip", $ref_alasan_pip, null, ["class" => "form-control select2"]) ],
			'id_alasan_tolak_kip' => ['Alasan Tolak Kip', Form::select("id_alasan_tolak_kip", $ref_alasan_tolak_kip, null, ["class" => "form-control select2"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_jenis_kelamin' => ['Jenis Kelamin', Form::select("id_jenis_kelamin", $ref_jenis_kelamin, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_tempat_tinggal' => ['Tempat Tinggal', Form::select("id_tempat_tinggal", $ref_tempat_tinggal, null, ["class" => "form-control select2"]) ],
			'id_transportasi' => ['Transportasi', Form::select("id_transportasi", $ref_transportasi, null, ["class" => "form-control select2"]) ],
			'is_kip' => ['Is Kip', Form::select("is_kip", ["1" => "Ya", "0" => "Tidak"], $siswa->is_kip, ["class" => "form-control", "required" => "required", "id" => "is_kip"]) ],
			'is_kps' => ['Is Kps', Form::select("is_kps", ["1" => "Ya", "0" => "Tidak"], $siswa->is_kps, ["class" => "form-control", "required" => "required", "id" => "is_kps"]) ],
			'is_pip' => ['Is Pip', Form::select("is_pip", ["1" => "Ya", "0" => "Tidak"], $siswa->is_pip, ["class" => "form-control", "required" => "required", "id" => "is_pip"]) ],
			'kode_pos' => ['Kode Pos', Form::text("kode_pos", $siswa->kode_pos, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "kode_pos"]) ],
			'lintang' => ['Lintang', Form::text("lintang", $siswa->lintang, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "lintang"]) ],
			'nama_di_kip' => ['Nama Di Kip', Form::text("nama_di_kip", $siswa->nama_di_kip, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_di_kip"]) ],
			'nama_siswa' => ['Nama Siswa', Form::text("nama_siswa", $siswa->nama_siswa, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_siswa"]) ],
			'nik' => ['Nik', Form::text("nik", $siswa->nik, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nik"]) ],
			'nis' => ['Nis', Form::text("nis", $siswa->nis, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nis"]) ],
			'nisn' => ['Nisn', Form::text("nisn", $siswa->nisn, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nisn"]) ],
			'no_akta_lahir' => ['No Akta Lahir', Form::text("no_akta_lahir", $siswa->no_akta_lahir, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_akta_lahir"]) ],
			'no_hp' => ['No Hp', Form::text("no_hp", $siswa->no_hp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_hp"]) ],
			'no_ijazah_smp' => ['No Ijazah Smp', Form::text("no_ijazah_smp", $siswa->no_ijazah_smp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_ijazah_smp"]) ],
			'no_kip' => ['No Kip', Form::text("no_kip", $siswa->no_kip, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_kip"]) ],
			'no_kks' => ['No Kks', Form::text("no_kks", $siswa->no_kks, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_kks"]) ],
			'no_kps' => ['No Kps', Form::text("no_kps", $siswa->no_kps, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_kps"]) ],
			'no_skhun_smp' => ['No Skhun Smp', Form::text("no_skhun_smp", $siswa->no_skhun_smp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_skhun_smp"]) ],
			'no_telp' => ['No Telp', Form::text("no_telp", $siswa->no_telp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_telp"]) ],
			'no_un_smp' => ['No Un Smp', Form::text("no_un_smp", $siswa->no_un_smp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "no_un_smp"]) ],
			'npsn_smp' => ['Npsn Smp', Form::text("npsn_smp", $siswa->npsn_smp, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "npsn_smp"]) ],
			'rt' => ['Rt', Form::text("rt", $siswa->rt, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "rt"]) ],
			'rw' => ['Rw', Form::text("rw", $siswa->rw, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "rw"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", $siswa->tgl_lahir, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_lahir"]) ],
			'tgl_masuk' => ['Tgl Masuk', Form::text("tgl_masuk", $siswa->tgl_masuk, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_masuk"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", $siswa->tmp_lahir, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "tmp_lahir"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return view('Siswa::siswa_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'alamat' => 'required',
			'asal_sekolah' => 'required',
			'bujur' => 'required',
			'dusun' => 'required',
			'email' => 'required',
			'id_agama' => 'required',
			'id_alasan_pip' => 'required',
			'id_alasan_tolak_kip' => 'required',
			'id_desa' => 'required',
			'id_disabilitas' => 'required',
			'id_jenis_kelamin' => 'required',
			'id_sekolah' => 'required',
			'id_tempat_tinggal' => 'required',
			'id_transportasi' => 'required',
			'is_kip' => 'required',
			'is_kps' => 'required',
			'is_pip' => 'required',
			'kode_pos' => 'required',
			'lintang' => 'required',
			'nama_di_kip' => 'required',
			'nama_siswa' => 'required',
			'nik' => 'required',
			'nis' => 'required',
			'nisn' => 'required',
			'no_akta_lahir' => 'required',
			'no_hp' => 'required',
			'no_ijazah_smp' => 'required',
			'no_kip' => 'required',
			'no_kks' => 'required',
			'no_kps' => 'required',
			'no_skhun_smp' => 'required',
			'no_telp' => 'required',
			'no_un_smp' => 'required',
			'npsn_smp' => 'required',
			'rt' => 'required',
			'rw' => 'required',
			'tgl_lahir' => 'required',
			'tgl_masuk' => 'required',
			'tmp_lahir' => 'required',
			
		]);
		
		$siswa = Siswa::find($id);
		$siswa->alamat = $request->input("alamat");
		$siswa->asal_sekolah = $request->input("asal_sekolah");
		$siswa->bujur = $request->input("bujur");
		$siswa->dusun = $request->input("dusun");
		$siswa->email = $request->input("email");
		$siswa->id_agama = $request->input("id_agama");
		$siswa->id_alasan_pip = $request->input("id_alasan_pip");
		$siswa->id_alasan_tolak_kip = $request->input("id_alasan_tolak_kip");
		$siswa->id_desa = $request->input("id_desa");
		$siswa->id_disabilitas = $request->input("id_disabilitas");
		$siswa->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$siswa->id_sekolah = $request->input("id_sekolah");
		$siswa->id_tempat_tinggal = $request->input("id_tempat_tinggal");
		$siswa->id_transportasi = $request->input("id_transportasi");
		$siswa->is_kip = $request->input("is_kip");
		$siswa->is_kps = $request->input("is_kps");
		$siswa->is_pip = $request->input("is_pip");
		$siswa->kode_pos = $request->input("kode_pos");
		$siswa->lintang = $request->input("lintang");
		$siswa->nama_di_kip = $request->input("nama_di_kip");
		$siswa->nama_siswa = $request->input("nama_siswa");
		$siswa->nik = $request->input("nik");
		$siswa->nis = $request->input("nis");
		$siswa->nisn = $request->input("nisn");
		$siswa->no_akta_lahir = $request->input("no_akta_lahir");
		$siswa->no_hp = $request->input("no_hp");
		$siswa->no_ijazah_smp = $request->input("no_ijazah_smp");
		$siswa->no_kip = $request->input("no_kip");
		$siswa->no_kks = $request->input("no_kks");
		$siswa->no_kps = $request->input("no_kps");
		$siswa->no_skhun_smp = $request->input("no_skhun_smp");
		$siswa->no_telp = $request->input("no_telp");
		$siswa->no_un_smp = $request->input("no_un_smp");
		$siswa->npsn_smp = $request->input("npsn_smp");
		$siswa->rt = $request->input("rt");
		$siswa->rw = $request->input("rw");
		$siswa->tgl_lahir = $request->input("tgl_lahir");
		$siswa->tgl_masuk = $request->input("tgl_masuk");
		$siswa->tmp_lahir = $request->input("tmp_lahir");
		
		$siswa->updated_by = Auth::id();
		$siswa->save();


		$text = 'mengedit '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return redirect()->route('siswa.index')->with('message_success', 'Siswa berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$siswa = Siswa::find($id);
		$siswa->deleted_by = Auth::id();
		$siswa->save();
		$siswa->delete();

		$text = 'menghapus '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return back()->with('message_success', 'Siswa berhasil dihapus!');
	}

}
