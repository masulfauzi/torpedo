<?php
namespace App\Modules\Keluarga\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Keluarga\Models\Keluarga;
use App\Modules\Disabilitas\Models\Disabilitas;
use App\Modules\HubKeluarga\Models\HubKeluarga;
use App\Modules\Pekerjaan\Models\Pekerjaan;
use App\Modules\Pendidikan\Models\Pendidikan;
use App\Modules\Penghasilan\Models\Penghasilan;
use App\Modules\Siswa\Models\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Keluarga";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Keluarga::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Keluarga::keluarga', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_hub_keluarga = HubKeluarga::all()->pluck('created_by','id');
		$ref_pekerjaan = Pekerjaan::all()->pluck('created_by','id');
		$ref_pendidikan = Pendidikan::all()->pluck('created_by','id');
		$ref_penghasilan = Penghasilan::all()->pluck('created_by','id');
		$ref_siswa = Siswa::all()->pluck('asal_sekolah','id');
		
		$data['forms'] = array(
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_hub_keluarga' => ['Hub Keluarga', Form::select("id_hub_keluarga", $ref_hub_keluarga, null, ["class" => "form-control select2"]) ],
			'id_pekerjaan' => ['Pekerjaan', Form::select("id_pekerjaan", $ref_pekerjaan, null, ["class" => "form-control select2"]) ],
			'id_pendidikan' => ['Pendidikan', Form::select("id_pendidikan", $ref_pendidikan, null, ["class" => "form-control select2"]) ],
			'id_penghasilan' => ['Penghasilan', Form::select("id_penghasilan", $ref_penghasilan, null, ["class" => "form-control select2"]) ],
			'id_siswa' => ['Siswa', Form::select("id_siswa", $ref_siswa, null, ["class" => "form-control select2"]) ],
			'nama' => ['Nama', Form::text("nama", old("nama"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'nik' => ['Nik', Form::text("nik", old("nik"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", old("tgl_lahir"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", old("tmp_lahir"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Keluarga::keluarga_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_disabilitas' => 'required',
			'id_hub_keluarga' => 'required',
			'id_pekerjaan' => 'required',
			'id_pendidikan' => 'required',
			'id_penghasilan' => 'required',
			'id_siswa' => 'required',
			'nama' => 'required',
			'nik' => 'required',
			'tgl_lahir' => 'required',
			'tmp_lahir' => 'required',
			
		]);

		$keluarga = new Keluarga();
		$keluarga->id_disabilitas = $request->input("id_disabilitas");
		$keluarga->id_hub_keluarga = $request->input("id_hub_keluarga");
		$keluarga->id_pekerjaan = $request->input("id_pekerjaan");
		$keluarga->id_pendidikan = $request->input("id_pendidikan");
		$keluarga->id_penghasilan = $request->input("id_penghasilan");
		$keluarga->id_siswa = $request->input("id_siswa");
		$keluarga->nama = $request->input("nama");
		$keluarga->nik = $request->input("nik");
		$keluarga->tgl_lahir = $request->input("tgl_lahir");
		$keluarga->tmp_lahir = $request->input("tmp_lahir");
		
		$keluarga->created_by = Auth::id();
		$keluarga->save();

		$text = 'membuat '.$this->title; //' baru '.$keluarga->what;
		$this->log($request, $text, ['keluarga.id' => $keluarga->id]);
		return redirect()->route('keluarga.index')->with('message_success', 'Keluarga berhasil ditambahkan!');
	}

	public function show(Request $request, Keluarga $keluarga)
	{
		$data['keluarga'] = $keluarga;

		$text = 'melihat detail '.$this->title;//.' '.$keluarga->what;
		$this->log($request, $text, ['keluarga.id' => $keluarga->id]);
		return view('Keluarga::keluarga_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Keluarga $keluarga)
	{
		$data['keluarga'] = $keluarga;

		$ref_disabilitas = Disabilitas::all()->pluck('created_by','id');
		$ref_hub_keluarga = HubKeluarga::all()->pluck('created_by','id');
		$ref_pekerjaan = Pekerjaan::all()->pluck('created_by','id');
		$ref_pendidikan = Pendidikan::all()->pluck('created_by','id');
		$ref_penghasilan = Penghasilan::all()->pluck('created_by','id');
		$ref_siswa = Siswa::all()->pluck('asal_sekolah','id');
		
		$data['forms'] = array(
			'id_disabilitas' => ['Disabilitas', Form::select("id_disabilitas", $ref_disabilitas, null, ["class" => "form-control select2"]) ],
			'id_hub_keluarga' => ['Hub Keluarga', Form::select("id_hub_keluarga", $ref_hub_keluarga, null, ["class" => "form-control select2"]) ],
			'id_pekerjaan' => ['Pekerjaan', Form::select("id_pekerjaan", $ref_pekerjaan, null, ["class" => "form-control select2"]) ],
			'id_pendidikan' => ['Pendidikan', Form::select("id_pendidikan", $ref_pendidikan, null, ["class" => "form-control select2"]) ],
			'id_penghasilan' => ['Penghasilan', Form::select("id_penghasilan", $ref_penghasilan, null, ["class" => "form-control select2"]) ],
			'id_siswa' => ['Siswa', Form::select("id_siswa", $ref_siswa, null, ["class" => "form-control select2"]) ],
			'nama' => ['Nama', Form::text("nama", $keluarga->nama, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama"]) ],
			'nik' => ['Nik', Form::text("nik", $keluarga->nik, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nik"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", $keluarga->tgl_lahir, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_lahir"]) ],
			'tmp_lahir' => ['Tmp Lahir', Form::text("tmp_lahir", $keluarga->tmp_lahir, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "tmp_lahir"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$keluarga->what;
		$this->log($request, $text, ['keluarga.id' => $keluarga->id]);
		return view('Keluarga::keluarga_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_disabilitas' => 'required',
			'id_hub_keluarga' => 'required',
			'id_pekerjaan' => 'required',
			'id_pendidikan' => 'required',
			'id_penghasilan' => 'required',
			'id_siswa' => 'required',
			'nama' => 'required',
			'nik' => 'required',
			'tgl_lahir' => 'required',
			'tmp_lahir' => 'required',
			
		]);
		
		$keluarga = Keluarga::find($id);
		$keluarga->id_disabilitas = $request->input("id_disabilitas");
		$keluarga->id_hub_keluarga = $request->input("id_hub_keluarga");
		$keluarga->id_pekerjaan = $request->input("id_pekerjaan");
		$keluarga->id_pendidikan = $request->input("id_pendidikan");
		$keluarga->id_penghasilan = $request->input("id_penghasilan");
		$keluarga->id_siswa = $request->input("id_siswa");
		$keluarga->nama = $request->input("nama");
		$keluarga->nik = $request->input("nik");
		$keluarga->tgl_lahir = $request->input("tgl_lahir");
		$keluarga->tmp_lahir = $request->input("tmp_lahir");
		
		$keluarga->updated_by = Auth::id();
		$keluarga->save();


		$text = 'mengedit '.$this->title;//.' '.$keluarga->what;
		$this->log($request, $text, ['keluarga.id' => $keluarga->id]);
		return redirect()->route('keluarga.index')->with('message_success', 'Keluarga berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$keluarga = Keluarga::find($id);
		$keluarga->deleted_by = Auth::id();
		$keluarga->save();
		$keluarga->delete();

		$text = 'menghapus '.$this->title;//.' '.$keluarga->what;
		$this->log($request, $text, ['keluarga.id' => $keluarga->id]);
		return back()->with('message_success', 'Keluarga berhasil dihapus!');
	}

}
