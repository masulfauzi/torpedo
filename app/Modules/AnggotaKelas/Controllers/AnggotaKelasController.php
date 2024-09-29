<?php
namespace App\Modules\AnggotaAnggotaKelas\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\AnggotaKelas\Models\AnggotaKelas;
use App\Modules\Siswa\Models\Siswa;
use App\Modules\Kelas\Models\Kelas;
use App\Modules\Semester\Models\Semester;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnggotaAnggotaKelasController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Anggota Kelas";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = AnggotaKelas::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('AnggotaKelas::anggotakelas', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_siswa = Siswa::all()->pluck('id_sekolah','id');
		$ref_kelas = Kelas::all()->pluck('id_sekolah','id');
		$ref_semester = Semester::all()->pluck('semester','id');
		
		$data['forms'] = array(
			'id_siswa' => ['Siswa', Form::select("id_siswa", $ref_siswa, null, ["class" => "form-control select2"]) ],
			'id_kelas' => ['Kelas', Form::select("id_kelas", $ref_kelas, null, ["class" => "form-control select2"]) ],
			'id_semester' => ['Semester', Form::select("id_semester", $ref_semester, null, ["class" => "form-control select2"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('AnggotaKelas::anggotakelas_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_siswa' => 'required',
			'id_kelas' => 'required',
			'id_semester' => 'required',
			
		]);

		$anggotakelas = new AnggotaKelas();
		$anggotakelas->id_siswa = $request->input("id_siswa");
		$anggotakelas->id_kelas = $request->input("id_kelas");
		$anggotakelas->id_semester = $request->input("id_semester");
		
		$anggotakelas->created_by = Auth::id();
		$anggotakelas->save();

		$text = 'membuat '.$this->title; //' baru '.$anggotakelas->what;
		$this->log($request, $text, ['anggotakelas.id' => $anggotakelas->id]);
		return redirect()->route('anggotakelas.index')->with('message_success', 'Anggota Kelas berhasil ditambahkan!');
	}

	public function show(Request $request, AnggotaKelas $anggotakelas)
	{
		$data['anggotakelas'] = $anggotakelas;

		$text = 'melihat detail '.$this->title;//.' '.$anggotakelas->what;
		$this->log($request, $text, ['anggotakelas.id' => $anggotakelas->id]);
		return view('AnggotaKelas::anggotakelas_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, AnggotaKelas $anggotakelas)
	{
		$data['anggotakelas'] = $anggotakelas;

		$ref_siswa = Siswa::all()->pluck('id_sekolah','id');
		$ref_kelas = Kelas::all()->pluck('id_sekolah','id');
		$ref_semester = Semester::all()->pluck('semester','id');
		
		$data['forms'] = array(
			'id_siswa' => ['Siswa', Form::select("id_siswa", $ref_siswa, null, ["class" => "form-control select2"]) ],
			'id_kelas' => ['Kelas', Form::select("id_kelas", $ref_kelas, null, ["class" => "form-control select2"]) ],
			'id_semester' => ['Semester', Form::select("id_semester", $ref_semester, null, ["class" => "form-control select2"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$anggotakelas->what;
		$this->log($request, $text, ['anggotakelas.id' => $anggotakelas->id]);
		return view('AnggotaKelas::anggotakelas_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_siswa' => 'required',
			'id_kelas' => 'required',
			'id_semester' => 'required',
			
		]);
		
		$anggotakelas = AnggotaKelas::find($id);
		$anggotakelas->id_siswa = $request->input("id_siswa");
		$anggotakelas->id_kelas = $request->input("id_kelas");
		$anggotakelas->id_semester = $request->input("id_semester");
		
		$anggotakelas->updated_by = Auth::id();
		$anggotakelas->save();


		$text = 'mengedit '.$this->title;//.' '.$anggotakelas->what;
		$this->log($request, $text, ['anggotakelas.id' => $anggotakelas->id]);
		return redirect()->route('anggotakelas.index')->with('message_success', 'Anggota Kelas berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$anggotakelas = AnggotaKelas::find($id);
		$anggotakelas->deleted_by = Auth::id();
		$anggotakelas->save();
		$anggotakelas->delete();

		$text = 'menghapus '.$this->title;//.' '.$anggotakelas->what;
		$this->log($request, $text, ['anggotakelas.id' => $anggotakelas->id]);
		return back()->with('message_success', 'Anggota Kelas berhasil dihapus!');
	}

}
