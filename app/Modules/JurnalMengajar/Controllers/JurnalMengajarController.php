<?php
namespace App\Modules\JurnalMengajar\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JurnalMengajar\Models\JurnalMengajar;
use App\Modules\Jadwal\Models\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JurnalMengajarController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jurnal Mengajar";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JurnalMengajar::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JurnalMengajar::jurnalmengajar', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_jadwal = Jadwal::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'id_jadwal' => ['Jadwal', Form::select("id_jadwal", $ref_jadwal, null, ["class" => "form-control select2"]) ],
			'materi' => ['Materi', Form::textarea("materi", old("materi"), ["class" => "form-control rich-editor"]) ],
			'tgl_pembelajaran' => ['Tgl Pembelajaran', Form::text("tgl_pembelajaran", old("tgl_pembelajaran"), ["class" => "form-control datepicker", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JurnalMengajar::jurnalmengajar_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_jadwal' => 'required',
			'materi' => 'required',
			'tgl_pembelajaran' => 'required',
			
		]);

		$jurnalmengajar = new JurnalMengajar();
		$jurnalmengajar->id_jadwal = $request->input("id_jadwal");
		$jurnalmengajar->materi = $request->input("materi");
		$jurnalmengajar->tgl_pembelajaran = $request->input("tgl_pembelajaran");
		
		$jurnalmengajar->created_by = Auth::id();
		$jurnalmengajar->save();

		$text = 'membuat '.$this->title; //' baru '.$jurnalmengajar->what;
		$this->log($request, $text, ['jurnalmengajar.id' => $jurnalmengajar->id]);
		return redirect()->route('jurnalmengajar.index')->with('message_success', 'Jurnal Mengajar berhasil ditambahkan!');
	}

	public function show(Request $request, JurnalMengajar $jurnalmengajar)
	{
		$data['jurnalmengajar'] = $jurnalmengajar;

		$text = 'melihat detail '.$this->title;//.' '.$jurnalmengajar->what;
		$this->log($request, $text, ['jurnalmengajar.id' => $jurnalmengajar->id]);
		return view('JurnalMengajar::jurnalmengajar_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JurnalMengajar $jurnalmengajar)
	{
		$data['jurnalmengajar'] = $jurnalmengajar;

		$ref_jadwal = Jadwal::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'id_jadwal' => ['Jadwal', Form::select("id_jadwal", $ref_jadwal, null, ["class" => "form-control select2"]) ],
			'materi' => ['Materi', Form::textarea("materi", $jurnalmengajar->materi, ["class" => "form-control rich-editor"]) ],
			'tgl_pembelajaran' => ['Tgl Pembelajaran', Form::text("tgl_pembelajaran", $jurnalmengajar->tgl_pembelajaran, ["class" => "form-control datepicker", "required" => "required", "id" => "tgl_pembelajaran"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jurnalmengajar->what;
		$this->log($request, $text, ['jurnalmengajar.id' => $jurnalmengajar->id]);
		return view('JurnalMengajar::jurnalmengajar_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_jadwal' => 'required',
			'materi' => 'required',
			'tgl_pembelajaran' => 'required',
			
		]);
		
		$jurnalmengajar = JurnalMengajar::find($id);
		$jurnalmengajar->id_jadwal = $request->input("id_jadwal");
		$jurnalmengajar->materi = $request->input("materi");
		$jurnalmengajar->tgl_pembelajaran = $request->input("tgl_pembelajaran");
		
		$jurnalmengajar->updated_by = Auth::id();
		$jurnalmengajar->save();


		$text = 'mengedit '.$this->title;//.' '.$jurnalmengajar->what;
		$this->log($request, $text, ['jurnalmengajar.id' => $jurnalmengajar->id]);
		return redirect()->route('jurnalmengajar.index')->with('message_success', 'Jurnal Mengajar berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jurnalmengajar = JurnalMengajar::find($id);
		$jurnalmengajar->deleted_by = Auth::id();
		$jurnalmengajar->save();
		$jurnalmengajar->delete();

		$text = 'menghapus '.$this->title;//.' '.$jurnalmengajar->what;
		$this->log($request, $text, ['jurnalmengajar.id' => $jurnalmengajar->id]);
		return back()->with('message_success', 'Jurnal Mengajar berhasil dihapus!');
	}

}
