<?php
namespace App\Modules\JenisSekolah\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JenisSekolah\Models\JenisSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenisSekolahController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jenis Sekolah";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JenisSekolah::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JenisSekolah::jenissekolah', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_sekolah' => ['Jenis Sekolah', Form::text("jenis_sekolah", old("jenis_sekolah"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JenisSekolah::jenissekolah_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'jenis_sekolah' => 'required',
			
		]);

		$jenissekolah = new JenisSekolah();
		$jenissekolah->jenis_sekolah = $request->input("jenis_sekolah");
		
		$jenissekolah->created_by = Auth::id();
		$jenissekolah->save();

		$text = 'membuat '.$this->title; //' baru '.$jenissekolah->what;
		$this->log($request, $text, ['jenissekolah.id' => $jenissekolah->id]);
		return redirect()->route('jenissekolah.index')->with('message_success', 'Jenis Sekolah berhasil ditambahkan!');
	}

	public function show(Request $request, JenisSekolah $jenissekolah)
	{
		$data['jenissekolah'] = $jenissekolah;

		$text = 'melihat detail '.$this->title;//.' '.$jenissekolah->what;
		$this->log($request, $text, ['jenissekolah.id' => $jenissekolah->id]);
		return view('JenisSekolah::jenissekolah_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JenisSekolah $jenissekolah)
	{
		$data['jenissekolah'] = $jenissekolah;

		
		$data['forms'] = array(
			'jenis_sekolah' => ['Jenis Sekolah', Form::text("jenis_sekolah", $jenissekolah->jenis_sekolah, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "jenis_sekolah"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jenissekolah->what;
		$this->log($request, $text, ['jenissekolah.id' => $jenissekolah->id]);
		return view('JenisSekolah::jenissekolah_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'jenis_sekolah' => 'required',
			
		]);
		
		$jenissekolah = JenisSekolah::find($id);
		$jenissekolah->jenis_sekolah = $request->input("jenis_sekolah");
		
		$jenissekolah->updated_by = Auth::id();
		$jenissekolah->save();


		$text = 'mengedit '.$this->title;//.' '.$jenissekolah->what;
		$this->log($request, $text, ['jenissekolah.id' => $jenissekolah->id]);
		return redirect()->route('jenissekolah.index')->with('message_success', 'Jenis Sekolah berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jenissekolah = JenisSekolah::find($id);
		$jenissekolah->deleted_by = Auth::id();
		$jenissekolah->save();
		$jenissekolah->delete();

		$text = 'menghapus '.$this->title;//.' '.$jenissekolah->what;
		$this->log($request, $text, ['jenissekolah.id' => $jenissekolah->id]);
		return back()->with('message_success', 'Jenis Sekolah berhasil dihapus!');
	}

}
