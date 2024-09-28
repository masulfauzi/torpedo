<?php
namespace App\Modules\Pendidikan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Pendidikan\Models\Pendidikan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Pendidikan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Pendidikan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Pendidikan::pendidikan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'pendidikan' => ['Pendidikan', Form::text("pendidikan", old("pendidikan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Pendidikan::pendidikan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'pendidikan' => 'required',
			
		]);

		$pendidikan = new Pendidikan();
		$pendidikan->pendidikan = $request->input("pendidikan");
		
		$pendidikan->created_by = Auth::id();
		$pendidikan->save();

		$text = 'membuat '.$this->title; //' baru '.$pendidikan->what;
		$this->log($request, $text, ['pendidikan.id' => $pendidikan->id]);
		return redirect()->route('pendidikan.index')->with('message_success', 'Pendidikan berhasil ditambahkan!');
	}

	public function show(Request $request, Pendidikan $pendidikan)
	{
		$data['pendidikan'] = $pendidikan;

		$text = 'melihat detail '.$this->title;//.' '.$pendidikan->what;
		$this->log($request, $text, ['pendidikan.id' => $pendidikan->id]);
		return view('Pendidikan::pendidikan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Pendidikan $pendidikan)
	{
		$data['pendidikan'] = $pendidikan;

		
		$data['forms'] = array(
			'pendidikan' => ['Pendidikan', Form::text("pendidikan", $pendidikan->pendidikan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "pendidikan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$pendidikan->what;
		$this->log($request, $text, ['pendidikan.id' => $pendidikan->id]);
		return view('Pendidikan::pendidikan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'pendidikan' => 'required',
			
		]);
		
		$pendidikan = Pendidikan::find($id);
		$pendidikan->pendidikan = $request->input("pendidikan");
		
		$pendidikan->updated_by = Auth::id();
		$pendidikan->save();


		$text = 'mengedit '.$this->title;//.' '.$pendidikan->what;
		$this->log($request, $text, ['pendidikan.id' => $pendidikan->id]);
		return redirect()->route('pendidikan.index')->with('message_success', 'Pendidikan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$pendidikan = Pendidikan::find($id);
		$pendidikan->deleted_by = Auth::id();
		$pendidikan->save();
		$pendidikan->delete();

		$text = 'menghapus '.$this->title;//.' '.$pendidikan->what;
		$this->log($request, $text, ['pendidikan.id' => $pendidikan->id]);
		return back()->with('message_success', 'Pendidikan berhasil dihapus!');
	}

}
