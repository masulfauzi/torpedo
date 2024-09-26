<?php
namespace App\Modules\Disabilitas\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Disabilitas\Models\Disabilitas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DisabilitasController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Disabilitas";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Disabilitas::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Disabilitas::disabilitas', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'disabilitas' => ['Disabilitas', Form::text("disabilitas", old("disabilitas"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'kode_disabilitas' => ['Kode Disabilitas', Form::text("kode_disabilitas", old("kode_disabilitas"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Disabilitas::disabilitas_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'disabilitas' => 'required',
			'kode_disabilitas' => 'required',
			
		]);

		$disabilitas = new Disabilitas();
		$disabilitas->disabilitas = $request->input("disabilitas");
		$disabilitas->kode_disabilitas = $request->input("kode_disabilitas");
		
		$disabilitas->created_by = Auth::id();
		$disabilitas->save();

		$text = 'membuat '.$this->title; //' baru '.$disabilitas->what;
		$this->log($request, $text, ['disabilitas.id' => $disabilitas->id]);
		return redirect()->route('disabilitas.index')->with('message_success', 'Disabilitas berhasil ditambahkan!');
	}

	public function show(Request $request, Disabilitas $disabilitas)
	{
		$data['disabilitas'] = $disabilitas;

		$text = 'melihat detail '.$this->title;//.' '.$disabilitas->what;
		$this->log($request, $text, ['disabilitas.id' => $disabilitas->id]);
		return view('Disabilitas::disabilitas_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Disabilitas $disabilitas)
	{
		$data['disabilitas'] = $disabilitas;

		
		$data['forms'] = array(
			'disabilitas' => ['Disabilitas', Form::text("disabilitas", $disabilitas->disabilitas, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "disabilitas"]) ],
			'kode_disabilitas' => ['Kode Disabilitas', Form::text("kode_disabilitas", $disabilitas->kode_disabilitas, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "kode_disabilitas"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$disabilitas->what;
		$this->log($request, $text, ['disabilitas.id' => $disabilitas->id]);
		return view('Disabilitas::disabilitas_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'disabilitas' => 'required',
			'kode_disabilitas' => 'required',
			
		]);
		
		$disabilitas = Disabilitas::find($id);
		$disabilitas->disabilitas = $request->input("disabilitas");
		$disabilitas->kode_disabilitas = $request->input("kode_disabilitas");
		
		$disabilitas->updated_by = Auth::id();
		$disabilitas->save();


		$text = 'mengedit '.$this->title;//.' '.$disabilitas->what;
		$this->log($request, $text, ['disabilitas.id' => $disabilitas->id]);
		return redirect()->route('disabilitas.index')->with('message_success', 'Disabilitas berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$disabilitas = Disabilitas::find($id);
		$disabilitas->deleted_by = Auth::id();
		$disabilitas->save();
		$disabilitas->delete();

		$text = 'menghapus '.$this->title;//.' '.$disabilitas->what;
		$this->log($request, $text, ['disabilitas.id' => $disabilitas->id]);
		return back()->with('message_success', 'Disabilitas berhasil dihapus!');
	}

}
