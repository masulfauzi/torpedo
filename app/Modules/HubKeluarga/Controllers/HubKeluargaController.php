<?php
namespace App\Modules\HubKeluarga\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\HubKeluarga\Models\HubKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HubKeluargaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Hub Keluarga";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = HubKeluarga::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('HubKeluarga::hubkeluarga', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'hub_keluarga' => ['Hub Keluarga', Form::text("hub_keluarga", old("hub_keluarga"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('HubKeluarga::hubkeluarga_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'hub_keluarga' => 'required',
			
		]);

		$hubkeluarga = new HubKeluarga();
		$hubkeluarga->hub_keluarga = $request->input("hub_keluarga");
		
		$hubkeluarga->created_by = Auth::id();
		$hubkeluarga->save();

		$text = 'membuat '.$this->title; //' baru '.$hubkeluarga->what;
		$this->log($request, $text, ['hubkeluarga.id' => $hubkeluarga->id]);
		return redirect()->route('hubkeluarga.index')->with('message_success', 'Hub Keluarga berhasil ditambahkan!');
	}

	public function show(Request $request, HubKeluarga $hubkeluarga)
	{
		$data['hubkeluarga'] = $hubkeluarga;

		$text = 'melihat detail '.$this->title;//.' '.$hubkeluarga->what;
		$this->log($request, $text, ['hubkeluarga.id' => $hubkeluarga->id]);
		return view('HubKeluarga::hubkeluarga_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, HubKeluarga $hubkeluarga)
	{
		$data['hubkeluarga'] = $hubkeluarga;

		
		$data['forms'] = array(
			'hub_keluarga' => ['Hub Keluarga', Form::text("hub_keluarga", $hubkeluarga->hub_keluarga, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "hub_keluarga"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$hubkeluarga->what;
		$this->log($request, $text, ['hubkeluarga.id' => $hubkeluarga->id]);
		return view('HubKeluarga::hubkeluarga_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'hub_keluarga' => 'required',
			
		]);
		
		$hubkeluarga = HubKeluarga::find($id);
		$hubkeluarga->hub_keluarga = $request->input("hub_keluarga");
		
		$hubkeluarga->updated_by = Auth::id();
		$hubkeluarga->save();


		$text = 'mengedit '.$this->title;//.' '.$hubkeluarga->what;
		$this->log($request, $text, ['hubkeluarga.id' => $hubkeluarga->id]);
		return redirect()->route('hubkeluarga.index')->with('message_success', 'Hub Keluarga berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$hubkeluarga = HubKeluarga::find($id);
		$hubkeluarga->deleted_by = Auth::id();
		$hubkeluarga->save();
		$hubkeluarga->delete();

		$text = 'menghapus '.$this->title;//.' '.$hubkeluarga->what;
		$this->log($request, $text, ['hubkeluarga.id' => $hubkeluarga->id]);
		return back()->with('message_success', 'Hub Keluarga berhasil dihapus!');
	}

}
