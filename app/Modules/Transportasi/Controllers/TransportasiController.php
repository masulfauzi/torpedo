<?php
namespace App\Modules\Transportasi\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Transportasi\Models\Transportasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransportasiController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Transportasi";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Transportasi::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Transportasi::transportasi', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'transportasi' => ['Transportasi', Form::text("transportasi", old("transportasi"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Transportasi::transportasi_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'transportasi' => 'required',
			
		]);

		$transportasi = new Transportasi();
		$transportasi->transportasi = $request->input("transportasi");
		
		$transportasi->created_by = Auth::id();
		$transportasi->save();

		$text = 'membuat '.$this->title; //' baru '.$transportasi->what;
		$this->log($request, $text, ['transportasi.id' => $transportasi->id]);
		return redirect()->route('transportasi.index')->with('message_success', 'Transportasi berhasil ditambahkan!');
	}

	public function show(Request $request, Transportasi $transportasi)
	{
		$data['transportasi'] = $transportasi;

		$text = 'melihat detail '.$this->title;//.' '.$transportasi->what;
		$this->log($request, $text, ['transportasi.id' => $transportasi->id]);
		return view('Transportasi::transportasi_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Transportasi $transportasi)
	{
		$data['transportasi'] = $transportasi;

		
		$data['forms'] = array(
			'transportasi' => ['Transportasi', Form::text("transportasi", $transportasi->transportasi, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "transportasi"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$transportasi->what;
		$this->log($request, $text, ['transportasi.id' => $transportasi->id]);
		return view('Transportasi::transportasi_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'transportasi' => 'required',
			
		]);
		
		$transportasi = Transportasi::find($id);
		$transportasi->transportasi = $request->input("transportasi");
		
		$transportasi->updated_by = Auth::id();
		$transportasi->save();


		$text = 'mengedit '.$this->title;//.' '.$transportasi->what;
		$this->log($request, $text, ['transportasi.id' => $transportasi->id]);
		return redirect()->route('transportasi.index')->with('message_success', 'Transportasi berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$transportasi = Transportasi::find($id);
		$transportasi->deleted_by = Auth::id();
		$transportasi->save();
		$transportasi->delete();

		$text = 'menghapus '.$this->title;//.' '.$transportasi->what;
		$this->log($request, $text, ['transportasi.id' => $transportasi->id]);
		return back()->with('message_success', 'Transportasi berhasil dihapus!');
	}

}
