<?php
namespace App\Modules\Mapel\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Mapel\Models\Mapel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Mapel";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Mapel::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Mapel::mapel', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'nama_mapel' => ['Nama Mapel', Form::text("nama_mapel", old("nama_mapel"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Mapel::mapel_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'nama_mapel' => 'required',
			
		]);

		$mapel = new Mapel();
		$mapel->nama_mapel = $request->input("nama_mapel");
		
		$mapel->created_by = Auth::id();
		$mapel->save();

		$text = 'membuat '.$this->title; //' baru '.$mapel->what;
		$this->log($request, $text, ['mapel.id' => $mapel->id]);
		return redirect()->route('mapel.index')->with('message_success', 'Mapel berhasil ditambahkan!');
	}

	public function show(Request $request, Mapel $mapel)
	{
		$data['mapel'] = $mapel;

		$text = 'melihat detail '.$this->title;//.' '.$mapel->what;
		$this->log($request, $text, ['mapel.id' => $mapel->id]);
		return view('Mapel::mapel_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Mapel $mapel)
	{
		$data['mapel'] = $mapel;

		
		$data['forms'] = array(
			'nama_mapel' => ['Nama Mapel', Form::text("nama_mapel", $mapel->nama_mapel, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "nama_mapel"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$mapel->what;
		$this->log($request, $text, ['mapel.id' => $mapel->id]);
		return view('Mapel::mapel_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'nama_mapel' => 'required',
			
		]);
		
		$mapel = Mapel::find($id);
		$mapel->nama_mapel = $request->input("nama_mapel");
		
		$mapel->updated_by = Auth::id();
		$mapel->save();


		$text = 'mengedit '.$this->title;//.' '.$mapel->what;
		$this->log($request, $text, ['mapel.id' => $mapel->id]);
		return redirect()->route('mapel.index')->with('message_success', 'Mapel berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$mapel = Mapel::find($id);
		$mapel->deleted_by = Auth::id();
		$mapel->save();
		$mapel->delete();

		$text = 'menghapus '.$this->title;//.' '.$mapel->what;
		$this->log($request, $text, ['mapel.id' => $mapel->id]);
		return back()->with('message_success', 'Mapel berhasil dihapus!');
	}

}
