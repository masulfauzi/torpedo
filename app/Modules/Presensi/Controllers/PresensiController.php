<?php
namespace App\Modules\Presensi\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Presensi\Models\Presensi;
use App\Modules\AnggotaKelas\Models\AnggotaKelas;
use App\Modules\StatusKehadiran\Models\StatusKehadiran;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Presensi";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Presensi::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Presensi::presensi', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_anggota_kelas = AnggotaKelas::all()->pluck('id_siswa','id');
		$ref_status_kehadiran = StatusKehadiran::all()->pluck('status_kehadiran','id');
		
		$data['forms'] = array(
			'id_anggota_kelas' => ['Anggota Kelas', Form::select("id_anggota_kelas", $ref_anggota_kelas, null, ["class" => "form-control select2"]) ],
			'id_status_kehadiran' => ['Status Kehadiran', Form::select("id_status_kehadiran", $ref_status_kehadiran, null, ["class" => "form-control select2"]) ],
			'keterangan' => ['Keterangan', Form::text("keterangan", old("keterangan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Presensi::presensi_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_anggota_kelas' => 'required',
			'id_status_kehadiran' => 'required',
			'keterangan' => 'required',
			
		]);

		$presensi = new Presensi();
		$presensi->id_anggota_kelas = $request->input("id_anggota_kelas");
		$presensi->id_status_kehadiran = $request->input("id_status_kehadiran");
		$presensi->keterangan = $request->input("keterangan");
		
		$presensi->created_by = Auth::id();
		$presensi->save();

		$text = 'membuat '.$this->title; //' baru '.$presensi->what;
		$this->log($request, $text, ['presensi.id' => $presensi->id]);
		return redirect()->route('presensi.index')->with('message_success', 'Presensi berhasil ditambahkan!');
	}

	public function show(Request $request, Presensi $presensi)
	{
		$data['presensi'] = $presensi;

		$text = 'melihat detail '.$this->title;//.' '.$presensi->what;
		$this->log($request, $text, ['presensi.id' => $presensi->id]);
		return view('Presensi::presensi_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Presensi $presensi)
	{
		$data['presensi'] = $presensi;

		$ref_anggota_kelas = AnggotaKelas::all()->pluck('id_siswa','id');
		$ref_status_kehadiran = StatusKehadiran::all()->pluck('status_kehadiran','id');
		
		$data['forms'] = array(
			'id_anggota_kelas' => ['Anggota Kelas', Form::select("id_anggota_kelas", $ref_anggota_kelas, null, ["class" => "form-control select2"]) ],
			'id_status_kehadiran' => ['Status Kehadiran', Form::select("id_status_kehadiran", $ref_status_kehadiran, null, ["class" => "form-control select2"]) ],
			'keterangan' => ['Keterangan', Form::text("keterangan", $presensi->keterangan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "keterangan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$presensi->what;
		$this->log($request, $text, ['presensi.id' => $presensi->id]);
		return view('Presensi::presensi_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_anggota_kelas' => 'required',
			'id_status_kehadiran' => 'required',
			'keterangan' => 'required',
			
		]);
		
		$presensi = Presensi::find($id);
		$presensi->id_anggota_kelas = $request->input("id_anggota_kelas");
		$presensi->id_status_kehadiran = $request->input("id_status_kehadiran");
		$presensi->keterangan = $request->input("keterangan");
		
		$presensi->updated_by = Auth::id();
		$presensi->save();


		$text = 'mengedit '.$this->title;//.' '.$presensi->what;
		$this->log($request, $text, ['presensi.id' => $presensi->id]);
		return redirect()->route('presensi.index')->with('message_success', 'Presensi berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$presensi = Presensi::find($id);
		$presensi->deleted_by = Auth::id();
		$presensi->save();
		$presensi->delete();

		$text = 'menghapus '.$this->title;//.' '.$presensi->what;
		$this->log($request, $text, ['presensi.id' => $presensi->id]);
		return back()->with('message_success', 'Presensi berhasil dihapus!');
	}

}
