<?php
namespace App\Modules\StatusPerkawinan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\StatusPerkawinan\Models\StatusPerkawinan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusPerkawinanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Status Perkawinan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = StatusPerkawinan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('StatusPerkawinan::statusperkawinan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_perkawinan' => ['Status Perkawinan', Form::text("status_perkawinan", old("status_perkawinan"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('StatusPerkawinan::statusperkawinan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_perkawinan' => 'required',
			
		]);

		$statusperkawinan = new StatusPerkawinan();
		$statusperkawinan->status_perkawinan = $request->input("status_perkawinan");
		
		$statusperkawinan->created_by = Auth::id();
		$statusperkawinan->save();

		$text = 'membuat '.$this->title; //' baru '.$statusperkawinan->what;
		$this->log($request, $text, ['statusperkawinan.id' => $statusperkawinan->id]);
		return redirect()->route('statusperkawinan.index')->with('message_success', 'Status Perkawinan berhasil ditambahkan!');
	}

	public function show(Request $request, StatusPerkawinan $statusperkawinan)
	{
		$data['statusperkawinan'] = $statusperkawinan;

		$text = 'melihat detail '.$this->title;//.' '.$statusperkawinan->what;
		$this->log($request, $text, ['statusperkawinan.id' => $statusperkawinan->id]);
		return view('StatusPerkawinan::statusperkawinan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, StatusPerkawinan $statusperkawinan)
	{
		$data['statusperkawinan'] = $statusperkawinan;

		
		$data['forms'] = array(
			'status_perkawinan' => ['Status Perkawinan', Form::text("status_perkawinan", $statusperkawinan->status_perkawinan, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "status_perkawinan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$statusperkawinan->what;
		$this->log($request, $text, ['statusperkawinan.id' => $statusperkawinan->id]);
		return view('StatusPerkawinan::statusperkawinan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_perkawinan' => 'required',
			
		]);
		
		$statusperkawinan = StatusPerkawinan::find($id);
		$statusperkawinan->status_perkawinan = $request->input("status_perkawinan");
		
		$statusperkawinan->updated_by = Auth::id();
		$statusperkawinan->save();


		$text = 'mengedit '.$this->title;//.' '.$statusperkawinan->what;
		$this->log($request, $text, ['statusperkawinan.id' => $statusperkawinan->id]);
		return redirect()->route('statusperkawinan.index')->with('message_success', 'Status Perkawinan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$statusperkawinan = StatusPerkawinan::find($id);
		$statusperkawinan->deleted_by = Auth::id();
		$statusperkawinan->save();
		$statusperkawinan->delete();

		$text = 'menghapus '.$this->title;//.' '.$statusperkawinan->what;
		$this->log($request, $text, ['statusperkawinan.id' => $statusperkawinan->id]);
		return back()->with('message_success', 'Status Perkawinan berhasil dihapus!');
	}

}
