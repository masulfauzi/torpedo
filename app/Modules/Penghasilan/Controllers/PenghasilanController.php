<?php
namespace App\Modules\Penghasilan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Penghasilan\Models\Penghasilan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenghasilanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Penghasilan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Penghasilan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Penghasilan::penghasilan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'penghasilan' => ['Penghasilan', Form::text("penghasilan", old("penghasilan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Penghasilan::penghasilan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'penghasilan' => 'required',
			
		]);

		$penghasilan = new Penghasilan();
		$penghasilan->penghasilan = $request->input("penghasilan");
		
		$penghasilan->created_by = Auth::id();
		$penghasilan->save();

		$text = 'membuat '.$this->title; //' baru '.$penghasilan->what;
		$this->log($request, $text, ['penghasilan.id' => $penghasilan->id]);
		return redirect()->route('penghasilan.index')->with('message_success', 'Penghasilan berhasil ditambahkan!');
	}

	public function show(Request $request, Penghasilan $penghasilan)
	{
		$data['penghasilan'] = $penghasilan;

		$text = 'melihat detail '.$this->title;//.' '.$penghasilan->what;
		$this->log($request, $text, ['penghasilan.id' => $penghasilan->id]);
		return view('Penghasilan::penghasilan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Penghasilan $penghasilan)
	{
		$data['penghasilan'] = $penghasilan;

		
		$data['forms'] = array(
			'penghasilan' => ['Penghasilan', Form::text("penghasilan", $penghasilan->penghasilan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "penghasilan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$penghasilan->what;
		$this->log($request, $text, ['penghasilan.id' => $penghasilan->id]);
		return view('Penghasilan::penghasilan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'penghasilan' => 'required',
			
		]);
		
		$penghasilan = Penghasilan::find($id);
		$penghasilan->penghasilan = $request->input("penghasilan");
		
		$penghasilan->updated_by = Auth::id();
		$penghasilan->save();


		$text = 'mengedit '.$this->title;//.' '.$penghasilan->what;
		$this->log($request, $text, ['penghasilan.id' => $penghasilan->id]);
		return redirect()->route('penghasilan.index')->with('message_success', 'Penghasilan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$penghasilan = Penghasilan::find($id);
		$penghasilan->deleted_by = Auth::id();
		$penghasilan->save();
		$penghasilan->delete();

		$text = 'menghapus '.$this->title;//.' '.$penghasilan->what;
		$this->log($request, $text, ['penghasilan.id' => $penghasilan->id]);
		return back()->with('message_success', 'Penghasilan berhasil dihapus!');
	}

}
