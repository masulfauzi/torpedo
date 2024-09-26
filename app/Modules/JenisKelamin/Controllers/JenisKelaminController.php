<?php
namespace App\Modules\JenisKelamin\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JenisKelamin\Models\JenisKelamin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenisKelaminController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jenis Kelamin";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JenisKelamin::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JenisKelamin::jeniskelamin', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_kelamin' => ['Jenis Kelamin', Form::text("jenis_kelamin", old("jenis_kelamin"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JenisKelamin::jeniskelamin_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'jenis_kelamin' => 'required',
			
		]);

		$jeniskelamin = new JenisKelamin();
		$jeniskelamin->jenis_kelamin = $request->input("jenis_kelamin");
		
		$jeniskelamin->created_by = Auth::id();
		$jeniskelamin->save();

		$text = 'membuat '.$this->title; //' baru '.$jeniskelamin->what;
		$this->log($request, $text, ['jeniskelamin.id' => $jeniskelamin->id]);
		return redirect()->route('jeniskelamin.index')->with('message_success', 'Jenis Kelamin berhasil ditambahkan!');
	}

	public function show(Request $request, JenisKelamin $jeniskelamin)
	{
		$data['jeniskelamin'] = $jeniskelamin;

		$text = 'melihat detail '.$this->title;//.' '.$jeniskelamin->what;
		$this->log($request, $text, ['jeniskelamin.id' => $jeniskelamin->id]);
		return view('JenisKelamin::jeniskelamin_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JenisKelamin $jeniskelamin)
	{
		$data['jeniskelamin'] = $jeniskelamin;

		
		$data['forms'] = array(
			'jenis_kelamin' => ['Jenis Kelamin', Form::text("jenis_kelamin", $jeniskelamin->jenis_kelamin, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "jenis_kelamin"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jeniskelamin->what;
		$this->log($request, $text, ['jeniskelamin.id' => $jeniskelamin->id]);
		return view('JenisKelamin::jeniskelamin_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'jenis_kelamin' => 'required',
			
		]);
		
		$jeniskelamin = JenisKelamin::find($id);
		$jeniskelamin->jenis_kelamin = $request->input("jenis_kelamin");
		
		$jeniskelamin->updated_by = Auth::id();
		$jeniskelamin->save();


		$text = 'mengedit '.$this->title;//.' '.$jeniskelamin->what;
		$this->log($request, $text, ['jeniskelamin.id' => $jeniskelamin->id]);
		return redirect()->route('jeniskelamin.index')->with('message_success', 'Jenis Kelamin berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jeniskelamin = JenisKelamin::find($id);
		$jeniskelamin->deleted_by = Auth::id();
		$jeniskelamin->save();
		$jeniskelamin->delete();

		$text = 'menghapus '.$this->title;//.' '.$jeniskelamin->what;
		$this->log($request, $text, ['jeniskelamin.id' => $jeniskelamin->id]);
		return back()->with('message_success', 'Jenis Kelamin berhasil dihapus!');
	}

}
