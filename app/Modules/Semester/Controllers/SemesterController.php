<?php
namespace App\Modules\Semester\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Semester\Models\Semester;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Semester";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Semester::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Semester::semester', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'semester' => ['Semester', Form::text("semester", old("semester"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'kode_semester' => ['Kode Semester', Form::text("kode_semester", old("kode_semester"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'tgl_mulai' => ['Tgl Mulai', Form::text("tgl_mulai", old("tgl_mulai"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'tgl_selesai' => ['Tgl Selesai', Form::text("tgl_selesai", old("tgl_selesai"), ["class" => "form-control datepicker", "required" => "required"]) ],
			'urutan' => ['Urutan', Form::text("urutan", old("urutan"), ["class" => "form-control","placeholder" => "n", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Semester::semester_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'semester' => 'required',
			'kode_semester' => 'required',
			'tgl_mulai' => 'required',
			'tgl_selesai' => 'required',
			'urutan' => 'required',
			
		]);

		$semester = new Semester();
		$semester->semester = $request->input("semester");
		$semester->kode_semester = $request->input("kode_semester");
		$semester->tgl_mulai = $request->input("tgl_mulai");
		$semester->tgl_selesai = $request->input("tgl_selesai");
		$semester->urutan = $request->input("urutan");
		
		$semester->created_by = Auth::id();
		$semester->save();

		$text = 'membuat '.$this->title; //' baru '.$semester->what;
		$this->log($request, $text, ['semester.id' => $semester->id]);
		return redirect()->route('semester.index')->with('message_success', 'Semester berhasil ditambahkan!');
	}

	public function show(Request $request, Semester $semester)
	{
		$data['semester'] = $semester;

		$text = 'melihat detail '.$this->title;//.' '.$semester->what;
		$this->log($request, $text, ['semester.id' => $semester->id]);
		return view('Semester::semester_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Semester $semester)
	{
		$data['semester'] = $semester;

		
		$data['forms'] = array(
			'semester' => ['Semester', Form::text("semester", $semester->semester, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "semester"]) ],
			'kode_semester' => ['Kode Semester', Form::text("kode_semester", $semester->kode_semester, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "kode_semester"]) ],
			'tgl_mulai' => ['Tgl Mulai', Form::text("tgl_mulai", $semester->tgl_mulai, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_mulai"]) ],
			'tgl_selesai' => ['Tgl Selesai', Form::text("tgl_selesai", $semester->tgl_selesai, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_selesai"]) ],
			'urutan' => ['Urutan', Form::text("urutan", $semester->urutan, ["class" => "form-control","placeholder" => "n", "required" => "required", "id" => "urutan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$semester->what;
		$this->log($request, $text, ['semester.id' => $semester->id]);
		return view('Semester::semester_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'semester' => 'required',
			'kode_semester' => 'required',
			'tgl_mulai' => 'required',
			'tgl_selesai' => 'required',
			'urutan' => 'required',
			
		]);
		
		$semester = Semester::find($id);
		$semester->semester = $request->input("semester");
		$semester->kode_semester = $request->input("kode_semester");
		$semester->tgl_mulai = $request->input("tgl_mulai");
		$semester->tgl_selesai = $request->input("tgl_selesai");
		$semester->urutan = $request->input("urutan");
		
		$semester->updated_by = Auth::id();
		$semester->save();


		$text = 'mengedit '.$this->title;//.' '.$semester->what;
		$this->log($request, $text, ['semester.id' => $semester->id]);
		return redirect()->route('semester.index')->with('message_success', 'Semester berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$semester = Semester::find($id);
		$semester->deleted_by = Auth::id();
		$semester->save();
		$semester->delete();

		$text = 'menghapus '.$this->title;//.' '.$semester->what;
		$this->log($request, $text, ['semester.id' => $semester->id]);
		return back()->with('message_success', 'Semester berhasil dihapus!');
	}

}
