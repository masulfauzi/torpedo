<?php
namespace App\Modules\StatusKehadiran\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\StatusKehadiran\Models\StatusKehadiran;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusKehadiranController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Status Kehadiran";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = StatusKehadiran::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('StatusKehadiran::statuskehadiran', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_kehadiran' => ['Status Kehadiran', Form::text("status_kehadiran", old("status_kehadiran"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('StatusKehadiran::statuskehadiran_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_kehadiran' => 'required',
			
		]);

		$statuskehadiran = new StatusKehadiran();
		$statuskehadiran->status_kehadiran = $request->input("status_kehadiran");
		
		$statuskehadiran->created_by = Auth::id();
		$statuskehadiran->save();

		$text = 'membuat '.$this->title; //' baru '.$statuskehadiran->what;
		$this->log($request, $text, ['statuskehadiran.id' => $statuskehadiran->id]);
		return redirect()->route('statuskehadiran.index')->with('message_success', 'Status Kehadiran berhasil ditambahkan!');
	}

	public function show(Request $request, StatusKehadiran $statuskehadiran)
	{
		$data['statuskehadiran'] = $statuskehadiran;

		$text = 'melihat detail '.$this->title;//.' '.$statuskehadiran->what;
		$this->log($request, $text, ['statuskehadiran.id' => $statuskehadiran->id]);
		return view('StatusKehadiran::statuskehadiran_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, StatusKehadiran $statuskehadiran)
	{
		$data['statuskehadiran'] = $statuskehadiran;

		
		$data['forms'] = array(
			'status_kehadiran' => ['Status Kehadiran', Form::text("status_kehadiran", $statuskehadiran->status_kehadiran, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "status_kehadiran"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$statuskehadiran->what;
		$this->log($request, $text, ['statuskehadiran.id' => $statuskehadiran->id]);
		return view('StatusKehadiran::statuskehadiran_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_kehadiran' => 'required',
			
		]);
		
		$statuskehadiran = StatusKehadiran::find($id);
		$statuskehadiran->status_kehadiran = $request->input("status_kehadiran");
		
		$statuskehadiran->updated_by = Auth::id();
		$statuskehadiran->save();


		$text = 'mengedit '.$this->title;//.' '.$statuskehadiran->what;
		$this->log($request, $text, ['statuskehadiran.id' => $statuskehadiran->id]);
		return redirect()->route('statuskehadiran.index')->with('message_success', 'Status Kehadiran berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$statuskehadiran = StatusKehadiran::find($id);
		$statuskehadiran->deleted_by = Auth::id();
		$statuskehadiran->save();
		$statuskehadiran->delete();

		$text = 'menghapus '.$this->title;//.' '.$statuskehadiran->what;
		$this->log($request, $text, ['statuskehadiran.id' => $statuskehadiran->id]);
		return back()->with('message_success', 'Status Kehadiran berhasil dihapus!');
	}

}
