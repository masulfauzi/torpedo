<?php
namespace App\Modules\Jadwal\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Jadwal\Models\Jadwal;
use App\Modules\Guru\Models\Guru;
use App\Modules\Hari\Models\Hari;
use App\Modules\JamMengajar\Models\JamMengajar;
use App\Modules\JamMengajar\Models\JamMengajar;
use App\Modules\Mapel\Models\Mapel;
use App\Modules\Ruang\Models\Ruang;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\Semester\Models\Semester;
use App\Modules\VersiJadwal\Models\VersiJadwal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jadwal";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Jadwal::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Jadwal::jadwal', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_guru = Guru::all()->pluck('bujur','id');
		$ref_hari = Hari::all()->pluck('created_by','id');
		$ref_jam_mengajar = JamMengajar::all()->pluck('created_by','id');
		$ref_jam_mengajar = JamMengajar::all()->pluck('created_by','id');
		$ref_mapel = Mapel::all()->pluck('created_by','id');
		$ref_ruang = Ruang::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_semester = Semester::all()->pluck('created_by','id');
		$ref_versi_jadwal = VersiJadwal::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'id_guru' => ['Guru', Form::select("id_guru", $ref_guru, null, ["class" => "form-control select2"]) ],
			'id_hari' => ['Hari', Form::select("id_hari", $ref_hari, null, ["class" => "form-control select2"]) ],
			'id_jam_mulai' => ['Jam Mulai', Form::select("id_jam_mulai", $ref_jam_mengajar, null, ["class" => "form-control select2"]) ],
			'id_jam_selesai' => ['Jam Selesai', Form::select("id_jam_selesai", $ref_jam_mengajar, null, ["class" => "form-control select2"]) ],
			'id_mapel' => ['Mapel', Form::select("id_mapel", $ref_mapel, null, ["class" => "form-control select2"]) ],
			'id_ruang' => ['Ruang', Form::select("id_ruang", $ref_ruang, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_semester' => ['Semester', Form::select("id_semester", $ref_semester, null, ["class" => "form-control select2"]) ],
			'id_versi_jadwal' => ['Versi Jadwal', Form::select("id_versi_jadwal", $ref_versi_jadwal, null, ["class" => "form-control select2"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Jadwal::jadwal_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_guru' => 'required',
			'id_hari' => 'required',
			'id_jam_mulai' => 'required',
			'id_jam_selesai' => 'required',
			'id_mapel' => 'required',
			'id_ruang' => 'required',
			'id_sekolah' => 'required',
			'id_semester' => 'required',
			'id_versi_jadwal' => 'required',
			
		]);

		$jadwal = new Jadwal();
		$jadwal->id_guru = $request->input("id_guru");
		$jadwal->id_hari = $request->input("id_hari");
		$jadwal->id_jam_mulai = $request->input("id_jam_mulai");
		$jadwal->id_jam_selesai = $request->input("id_jam_selesai");
		$jadwal->id_mapel = $request->input("id_mapel");
		$jadwal->id_ruang = $request->input("id_ruang");
		$jadwal->id_sekolah = $request->input("id_sekolah");
		$jadwal->id_semester = $request->input("id_semester");
		$jadwal->id_versi_jadwal = $request->input("id_versi_jadwal");
		
		$jadwal->created_by = Auth::id();
		$jadwal->save();

		$text = 'membuat '.$this->title; //' baru '.$jadwal->what;
		$this->log($request, $text, ['jadwal.id' => $jadwal->id]);
		return redirect()->route('jadwal.index')->with('message_success', 'Jadwal berhasil ditambahkan!');
	}

	public function show(Request $request, Jadwal $jadwal)
	{
		$data['jadwal'] = $jadwal;

		$text = 'melihat detail '.$this->title;//.' '.$jadwal->what;
		$this->log($request, $text, ['jadwal.id' => $jadwal->id]);
		return view('Jadwal::jadwal_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Jadwal $jadwal)
	{
		$data['jadwal'] = $jadwal;

		$ref_guru = Guru::all()->pluck('bujur','id');
		$ref_hari = Hari::all()->pluck('created_by','id');
		$ref_jam_mengajar = JamMengajar::all()->pluck('created_by','id');
		$ref_jam_mengajar = JamMengajar::all()->pluck('created_by','id');
		$ref_mapel = Mapel::all()->pluck('created_by','id');
		$ref_ruang = Ruang::all()->pluck('created_by','id');
		$ref_sekolah = Sekolah::all()->pluck('created_at','id');
		$ref_semester = Semester::all()->pluck('created_by','id');
		$ref_versi_jadwal = VersiJadwal::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'id_guru' => ['Guru', Form::select("id_guru", $ref_guru, null, ["class" => "form-control select2"]) ],
			'id_hari' => ['Hari', Form::select("id_hari", $ref_hari, null, ["class" => "form-control select2"]) ],
			'id_jam_mulai' => ['Jam Mulai', Form::select("id_jam_mulai", $ref_jam_mengajar, null, ["class" => "form-control select2"]) ],
			'id_jam_selesai' => ['Jam Selesai', Form::select("id_jam_selesai", $ref_jam_mengajar, null, ["class" => "form-control select2"]) ],
			'id_mapel' => ['Mapel', Form::select("id_mapel", $ref_mapel, null, ["class" => "form-control select2"]) ],
			'id_ruang' => ['Ruang', Form::select("id_ruang", $ref_ruang, null, ["class" => "form-control select2"]) ],
			'id_sekolah' => ['Sekolah', Form::select("id_sekolah", $ref_sekolah, null, ["class" => "form-control select2"]) ],
			'id_semester' => ['Semester', Form::select("id_semester", $ref_semester, null, ["class" => "form-control select2"]) ],
			'id_versi_jadwal' => ['Versi Jadwal', Form::select("id_versi_jadwal", $ref_versi_jadwal, null, ["class" => "form-control select2"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jadwal->what;
		$this->log($request, $text, ['jadwal.id' => $jadwal->id]);
		return view('Jadwal::jadwal_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_guru' => 'required',
			'id_hari' => 'required',
			'id_jam_mulai' => 'required',
			'id_jam_selesai' => 'required',
			'id_mapel' => 'required',
			'id_ruang' => 'required',
			'id_sekolah' => 'required',
			'id_semester' => 'required',
			'id_versi_jadwal' => 'required',
			
		]);
		
		$jadwal = Jadwal::find($id);
		$jadwal->id_guru = $request->input("id_guru");
		$jadwal->id_hari = $request->input("id_hari");
		$jadwal->id_jam_mulai = $request->input("id_jam_mulai");
		$jadwal->id_jam_selesai = $request->input("id_jam_selesai");
		$jadwal->id_mapel = $request->input("id_mapel");
		$jadwal->id_ruang = $request->input("id_ruang");
		$jadwal->id_sekolah = $request->input("id_sekolah");
		$jadwal->id_semester = $request->input("id_semester");
		$jadwal->id_versi_jadwal = $request->input("id_versi_jadwal");
		
		$jadwal->updated_by = Auth::id();
		$jadwal->save();


		$text = 'mengedit '.$this->title;//.' '.$jadwal->what;
		$this->log($request, $text, ['jadwal.id' => $jadwal->id]);
		return redirect()->route('jadwal.index')->with('message_success', 'Jadwal berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jadwal = Jadwal::find($id);
		$jadwal->deleted_by = Auth::id();
		$jadwal->save();
		$jadwal->delete();

		$text = 'menghapus '.$this->title;//.' '.$jadwal->what;
		$this->log($request, $text, ['jadwal.id' => $jadwal->id]);
		return back()->with('message_success', 'Jadwal berhasil dihapus!');
	}

}
