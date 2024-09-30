<?php
namespace App\Modules\JamMengajar\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JamMengajar\Models\JamMengajar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JamMengajarController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jam Mengajar";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JamMengajar::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JamMengajar::jammengajar', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jam_mengajar' => ['Jam Mengajar', Form::text("jam_mengajar", old("jam_mengajar"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			'urutan' => ['Urutan', Form::text("urutan", old("urutan"), ["class" => "form-control","placeholder" => "n", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JamMengajar::jammengajar_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'jam_mengajar' => 'required',
			'urutan' => 'required',
			
		]);

		$jammengajar = new JamMengajar();
		$jammengajar->jam_mengajar = $request->input("jam_mengajar");
		$jammengajar->urutan = $request->input("urutan");
		
		$jammengajar->created_by = Auth::id();
		$jammengajar->save();

		$text = 'membuat '.$this->title; //' baru '.$jammengajar->what;
		$this->log($request, $text, ['jammengajar.id' => $jammengajar->id]);
		return redirect()->route('jammengajar.index')->with('message_success', 'Jam Mengajar berhasil ditambahkan!');
	}

	public function show(Request $request, JamMengajar $jammengajar)
	{
		$data['jammengajar'] = $jammengajar;

		$text = 'melihat detail '.$this->title;//.' '.$jammengajar->what;
		$this->log($request, $text, ['jammengajar.id' => $jammengajar->id]);
		return view('JamMengajar::jammengajar_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JamMengajar $jammengajar)
	{
		$data['jammengajar'] = $jammengajar;

		
		$data['forms'] = array(
			'jam_mengajar' => ['Jam Mengajar', Form::text("jam_mengajar", $jammengajar->jam_mengajar, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "jam_mengajar"]) ],
			'urutan' => ['Urutan', Form::text("urutan", $jammengajar->urutan, ["class" => "form-control","placeholder" => "n", "required" => "required", "id" => "urutan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jammengajar->what;
		$this->log($request, $text, ['jammengajar.id' => $jammengajar->id]);
		return view('JamMengajar::jammengajar_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'jam_mengajar' => 'required',
			'urutan' => 'required',
			
		]);
		
		$jammengajar = JamMengajar::find($id);
		$jammengajar->jam_mengajar = $request->input("jam_mengajar");
		$jammengajar->urutan = $request->input("urutan");
		
		$jammengajar->updated_by = Auth::id();
		$jammengajar->save();


		$text = 'mengedit '.$this->title;//.' '.$jammengajar->what;
		$this->log($request, $text, ['jammengajar.id' => $jammengajar->id]);
		return redirect()->route('jammengajar.index')->with('message_success', 'Jam Mengajar berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jammengajar = JamMengajar::find($id);
		$jammengajar->deleted_by = Auth::id();
		$jammengajar->save();
		$jammengajar->delete();

		$text = 'menghapus '.$this->title;//.' '.$jammengajar->what;
		$this->log($request, $text, ['jammengajar.id' => $jammengajar->id]);
		return back()->with('message_success', 'Jam Mengajar berhasil dihapus!');
	}

}
