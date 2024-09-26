<?php
namespace App\Modules\Sekolah\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\JenisSekolah\Models\JenisSekolah;
use App\Modules\StatusSekolah\Models\StatusSekolah;
use App\Modules\Desa\Models\Desa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SekolahController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Sekolah";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Sekolah::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Sekolah::sekolah', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_jenis_sekolah = JenisSekolah::all()->pluck('jenis_sekolah','id');
		$ref_status_sekolah = StatusSekolah::all()->pluck('status_sekolah','id');
		$ref_desa = Desa::all()->pluck('id_kecamatan','id');
		
		$data['forms'] = array(
			'id_jenis_sekolah' => ['Jenis Sekolah', Form::select("id_jenis_sekolah", $ref_jenis_sekolah, null, ["class" => "form-control select2"]) ],
			'id_status_sekolah' => ['Status Sekolah', Form::select("id_status_sekolah", $ref_status_sekolah, null, ["class" => "form-control select2"]) ],
			'nama_sekolah' => ['Nama Sekolah', Form::text("nama_sekolah", old("nama_sekolah"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'npsn' => ['Npsn', Form::text("npsn", old("npsn"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'alamat' => ['Alamat', Form::textarea("alamat", old("alamat"), ["class" => "form-control rich-editor"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Sekolah::sekolah_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_jenis_sekolah' => 'required',
			'id_status_sekolah' => 'required',
			'nama_sekolah' => 'required',
			'npsn' => 'required',
			'alamat' => 'required',
			'id_desa' => 'required',
			
		]);

		$sekolah = new Sekolah();
		$sekolah->id_jenis_sekolah = $request->input("id_jenis_sekolah");
		$sekolah->id_status_sekolah = $request->input("id_status_sekolah");
		$sekolah->nama_sekolah = $request->input("nama_sekolah");
		$sekolah->npsn = $request->input("npsn");
		$sekolah->alamat = $request->input("alamat");
		$sekolah->id_desa = $request->input("id_desa");
		
		$sekolah->created_by = Auth::id();
		$sekolah->save();

		$text = 'membuat '.$this->title; //' baru '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return redirect()->route('sekolah.index')->with('message_success', 'Sekolah berhasil ditambahkan!');
	}

	public function show(Request $request, Sekolah $sekolah)
	{
		$data['sekolah'] = $sekolah;

		$text = 'melihat detail '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return view('Sekolah::sekolah_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Sekolah $sekolah)
	{
		$data['sekolah'] = $sekolah;

		$ref_jenis_sekolah = JenisSekolah::all()->pluck('jenis_sekolah','id');
		$ref_status_sekolah = StatusSekolah::all()->pluck('status_sekolah','id');
		$ref_desa = Desa::all()->pluck('id_kecamatan','id');
		
		$data['forms'] = array(
			'id_jenis_sekolah' => ['Jenis Sekolah', Form::select("id_jenis_sekolah", $ref_jenis_sekolah, null, ["class" => "form-control select2"]) ],
			'id_status_sekolah' => ['Status Sekolah', Form::select("id_status_sekolah", $ref_status_sekolah, null, ["class" => "form-control select2"]) ],
			'nama_sekolah' => ['Nama Sekolah', Form::text("nama_sekolah", $sekolah->nama_sekolah, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_sekolah"]) ],
			'npsn' => ['Npsn', Form::text("npsn", $sekolah->npsn, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "npsn"]) ],
			'alamat' => ['Alamat', Form::textarea("alamat", $sekolah->alamat, ["class" => "form-control rich-editor"]) ],
			'id_desa' => ['Desa', Form::select("id_desa", $ref_desa, null, ["class" => "form-control select2"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return view('Sekolah::sekolah_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_jenis_sekolah' => 'required',
			'id_status_sekolah' => 'required',
			'nama_sekolah' => 'required',
			'npsn' => 'required',
			'alamat' => 'required',
			'id_desa' => 'required',
			
		]);
		
		$sekolah = Sekolah::find($id);
		$sekolah->id_jenis_sekolah = $request->input("id_jenis_sekolah");
		$sekolah->id_status_sekolah = $request->input("id_status_sekolah");
		$sekolah->nama_sekolah = $request->input("nama_sekolah");
		$sekolah->npsn = $request->input("npsn");
		$sekolah->alamat = $request->input("alamat");
		$sekolah->id_desa = $request->input("id_desa");
		
		$sekolah->updated_by = Auth::id();
		$sekolah->save();


		$text = 'mengedit '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return redirect()->route('sekolah.index')->with('message_success', 'Sekolah berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$sekolah = Sekolah::find($id);
		$sekolah->deleted_by = Auth::id();
		$sekolah->save();
		$sekolah->delete();

		$text = 'menghapus '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return back()->with('message_success', 'Sekolah berhasil dihapus!');
	}

}
