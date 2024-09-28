<?php
namespace App\Modules\NamaJurusan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\NamaJurusan\Models\NamaJurusan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NamaJurusanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Nama Jurusan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = NamaJurusan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('NamaJurusan::namajurusan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'nama_jurusan' => ['Nama Jurusan', Form::text("nama_jurusan", old("nama_jurusan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('NamaJurusan::namajurusan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'nama_jurusan' => 'required',
			
		]);

		$namajurusan = new NamaJurusan();
		$namajurusan->nama_jurusan = $request->input("nama_jurusan");
		
		$namajurusan->created_by = Auth::id();
		$namajurusan->save();

		$text = 'membuat '.$this->title; //' baru '.$namajurusan->what;
		$this->log($request, $text, ['namajurusan.id' => $namajurusan->id]);
		return redirect()->route('namajurusan.index')->with('message_success', 'Nama Jurusan berhasil ditambahkan!');
	}

	public function show(Request $request, NamaJurusan $namajurusan)
	{
		$data['namajurusan'] = $namajurusan;

		$text = 'melihat detail '.$this->title;//.' '.$namajurusan->what;
		$this->log($request, $text, ['namajurusan.id' => $namajurusan->id]);
		return view('NamaJurusan::namajurusan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, NamaJurusan $namajurusan)
	{
		$data['namajurusan'] = $namajurusan;

		
		$data['forms'] = array(
			'nama_jurusan' => ['Nama Jurusan', Form::text("nama_jurusan", $namajurusan->nama_jurusan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_jurusan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$namajurusan->what;
		$this->log($request, $text, ['namajurusan.id' => $namajurusan->id]);
		return view('NamaJurusan::namajurusan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'nama_jurusan' => 'required',
			
		]);
		
		$namajurusan = NamaJurusan::find($id);
		$namajurusan->nama_jurusan = $request->input("nama_jurusan");
		
		$namajurusan->updated_by = Auth::id();
		$namajurusan->save();


		$text = 'mengedit '.$this->title;//.' '.$namajurusan->what;
		$this->log($request, $text, ['namajurusan.id' => $namajurusan->id]);
		return redirect()->route('namajurusan.index')->with('message_success', 'Nama Jurusan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$namajurusan = NamaJurusan::find($id);
		$namajurusan->deleted_by = Auth::id();
		$namajurusan->save();
		$namajurusan->delete();

		$text = 'menghapus '.$this->title;//.' '.$namajurusan->what;
		$this->log($request, $text, ['namajurusan.id' => $namajurusan->id]);
		return back()->with('message_success', 'Nama Jurusan berhasil dihapus!');
	}

}
