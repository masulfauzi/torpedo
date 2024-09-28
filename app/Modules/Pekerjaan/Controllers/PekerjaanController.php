<?php
namespace App\Modules\Pekerjaan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Pekerjaan\Models\Pekerjaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PekerjaanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Pekerjaan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Pekerjaan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Pekerjaan::pekerjaan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'pekerjaan' => ['Pekerjaan', Form::text("pekerjaan", old("pekerjaan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Pekerjaan::pekerjaan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'pekerjaan' => 'required',
			
		]);

		$pekerjaan = new Pekerjaan();
		$pekerjaan->pekerjaan = $request->input("pekerjaan");
		
		$pekerjaan->created_by = Auth::id();
		$pekerjaan->save();

		$text = 'membuat '.$this->title; //' baru '.$pekerjaan->what;
		$this->log($request, $text, ['pekerjaan.id' => $pekerjaan->id]);
		return redirect()->route('pekerjaan.index')->with('message_success', 'Pekerjaan berhasil ditambahkan!');
	}

	public function show(Request $request, Pekerjaan $pekerjaan)
	{
		$data['pekerjaan'] = $pekerjaan;

		$text = 'melihat detail '.$this->title;//.' '.$pekerjaan->what;
		$this->log($request, $text, ['pekerjaan.id' => $pekerjaan->id]);
		return view('Pekerjaan::pekerjaan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Pekerjaan $pekerjaan)
	{
		$data['pekerjaan'] = $pekerjaan;

		
		$data['forms'] = array(
			'pekerjaan' => ['Pekerjaan', Form::text("pekerjaan", $pekerjaan->pekerjaan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "pekerjaan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$pekerjaan->what;
		$this->log($request, $text, ['pekerjaan.id' => $pekerjaan->id]);
		return view('Pekerjaan::pekerjaan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'pekerjaan' => 'required',
			
		]);
		
		$pekerjaan = Pekerjaan::find($id);
		$pekerjaan->pekerjaan = $request->input("pekerjaan");
		
		$pekerjaan->updated_by = Auth::id();
		$pekerjaan->save();


		$text = 'mengedit '.$this->title;//.' '.$pekerjaan->what;
		$this->log($request, $text, ['pekerjaan.id' => $pekerjaan->id]);
		return redirect()->route('pekerjaan.index')->with('message_success', 'Pekerjaan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$pekerjaan = Pekerjaan::find($id);
		$pekerjaan->deleted_by = Auth::id();
		$pekerjaan->save();
		$pekerjaan->delete();

		$text = 'menghapus '.$this->title;//.' '.$pekerjaan->what;
		$this->log($request, $text, ['pekerjaan.id' => $pekerjaan->id]);
		return back()->with('message_success', 'Pekerjaan berhasil dihapus!');
	}

}
