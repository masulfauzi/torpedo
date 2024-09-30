<?php
namespace App\Modules\VersiJadwal\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\VersiJadwal\Models\VersiJadwal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VersiJadwalController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Versi Jadwal";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = VersiJadwal::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('VersiJadwal::versijadwal', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'is_aktif' => ['Is Aktif', Form::select("is_aktif", ["1" => "Ya", "0" => "Tidak"], old("is_aktif"), ["class" => "form-control", "required" => "required"]) ],
			'versi_jadwal' => ['Versi Jadwal', Form::text("versi_jadwal", old("versi_jadwal"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('VersiJadwal::versijadwal_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'is_aktif' => 'required',
			'versi_jadwal' => 'required',
			
		]);

		$versijadwal = new VersiJadwal();
		$versijadwal->is_aktif = $request->input("is_aktif");
		$versijadwal->versi_jadwal = $request->input("versi_jadwal");
		
		$versijadwal->created_by = Auth::id();
		$versijadwal->save();

		$text = 'membuat '.$this->title; //' baru '.$versijadwal->what;
		$this->log($request, $text, ['versijadwal.id' => $versijadwal->id]);
		return redirect()->route('versijadwal.index')->with('message_success', 'Versi Jadwal berhasil ditambahkan!');
	}

	public function show(Request $request, VersiJadwal $versijadwal)
	{
		$data['versijadwal'] = $versijadwal;

		$text = 'melihat detail '.$this->title;//.' '.$versijadwal->what;
		$this->log($request, $text, ['versijadwal.id' => $versijadwal->id]);
		return view('VersiJadwal::versijadwal_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, VersiJadwal $versijadwal)
	{
		$data['versijadwal'] = $versijadwal;

		
		$data['forms'] = array(
			'is_aktif' => ['Is Aktif', Form::select("is_aktif", ["1" => "Ya", "0" => "Tidak"], $versijadwal->is_aktif, ["class" => "form-control", "required" => "required", "id" => "is_aktif"]) ],
			'versi_jadwal' => ['Versi Jadwal', Form::text("versi_jadwal", $versijadwal->versi_jadwal, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "versi_jadwal"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$versijadwal->what;
		$this->log($request, $text, ['versijadwal.id' => $versijadwal->id]);
		return view('VersiJadwal::versijadwal_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'is_aktif' => 'required',
			'versi_jadwal' => 'required',
			
		]);
		
		$versijadwal = VersiJadwal::find($id);
		$versijadwal->is_aktif = $request->input("is_aktif");
		$versijadwal->versi_jadwal = $request->input("versi_jadwal");
		
		$versijadwal->updated_by = Auth::id();
		$versijadwal->save();


		$text = 'mengedit '.$this->title;//.' '.$versijadwal->what;
		$this->log($request, $text, ['versijadwal.id' => $versijadwal->id]);
		return redirect()->route('versijadwal.index')->with('message_success', 'Versi Jadwal berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$versijadwal = VersiJadwal::find($id);
		$versijadwal->deleted_by = Auth::id();
		$versijadwal->save();
		$versijadwal->delete();

		$text = 'menghapus '.$this->title;//.' '.$versijadwal->what;
		$this->log($request, $text, ['versijadwal.id' => $versijadwal->id]);
		return back()->with('message_success', 'Versi Jadwal berhasil dihapus!');
	}

}
