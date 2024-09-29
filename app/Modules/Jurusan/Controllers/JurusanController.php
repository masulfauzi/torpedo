<?php
namespace App\Modules\Jurusan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Jurusan\Models\Jurusan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jurusan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Jurusan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Jurusan::jurusan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'nama_jurusan' => ['Nama Jurusan', Form::text("nama_jurusan", old("nama_jurusan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Jurusan::jurusan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'nama_jurusan' => 'required',
			
		]);

		$jurusan = new Jurusan();
		$jurusan->nama_jurusan = $request->input("nama_jurusan");
		
		$jurusan->created_by = Auth::id();
		$jurusan->save();

		$text = 'membuat '.$this->title; //' baru '.$jurusan->what;
		$this->log($request, $text, ['jurusan.id' => $jurusan->id]);
		return redirect()->route('jurusan.index')->with('message_success', 'Jurusan berhasil ditambahkan!');
	}

	public function show(Request $request, Jurusan $jurusan)
	{
		$data['jurusan'] = $jurusan;

		$text = 'melihat detail '.$this->title;//.' '.$jurusan->what;
		$this->log($request, $text, ['jurusan.id' => $jurusan->id]);
		return view('Jurusan::jurusan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Jurusan $jurusan)
	{
		$data['jurusan'] = $jurusan;

		
		$data['forms'] = array(
			'nama_jurusan' => ['Nama Jurusan', Form::text("nama_jurusan", $jurusan->nama_jurusan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_jurusan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jurusan->what;
		$this->log($request, $text, ['jurusan.id' => $jurusan->id]);
		return view('Jurusan::jurusan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'nama_jurusan' => 'required',
			
		]);
		
		$jurusan = Jurusan::find($id);
		$jurusan->nama_jurusan = $request->input("nama_jurusan");
		
		$jurusan->updated_by = Auth::id();
		$jurusan->save();


		$text = 'mengedit '.$this->title;//.' '.$jurusan->what;
		$this->log($request, $text, ['jurusan.id' => $jurusan->id]);
		return redirect()->route('jurusan.index')->with('message_success', 'Jurusan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jurusan = Jurusan::find($id);
		$jurusan->deleted_by = Auth::id();
		$jurusan->save();
		$jurusan->delete();

		$text = 'menghapus '.$this->title;//.' '.$jurusan->what;
		$this->log($request, $text, ['jurusan.id' => $jurusan->id]);
		return back()->with('message_success', 'Jurusan berhasil dihapus!');
	}

}
