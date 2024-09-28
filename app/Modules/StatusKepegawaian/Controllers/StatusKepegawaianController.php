<?php
namespace App\Modules\StatusKepegawaian\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\StatusKepegawaian\Models\StatusKepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusKepegawaianController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Status Kepegawaian";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = StatusKepegawaian::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('StatusKepegawaian::statuskepegawaian', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_kepegawaian' => ['Status Kepegawaian', Form::text("status_kepegawaian", old("status_kepegawaian"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('StatusKepegawaian::statuskepegawaian_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_kepegawaian' => 'required',
			
		]);

		$statuskepegawaian = new StatusKepegawaian();
		$statuskepegawaian->status_kepegawaian = $request->input("status_kepegawaian");
		
		$statuskepegawaian->created_by = Auth::id();
		$statuskepegawaian->save();

		$text = 'membuat '.$this->title; //' baru '.$statuskepegawaian->what;
		$this->log($request, $text, ['statuskepegawaian.id' => $statuskepegawaian->id]);
		return redirect()->route('statuskepegawaian.index')->with('message_success', 'Status Kepegawaian berhasil ditambahkan!');
	}

	public function show(Request $request, StatusKepegawaian $statuskepegawaian)
	{
		$data['statuskepegawaian'] = $statuskepegawaian;

		$text = 'melihat detail '.$this->title;//.' '.$statuskepegawaian->what;
		$this->log($request, $text, ['statuskepegawaian.id' => $statuskepegawaian->id]);
		return view('StatusKepegawaian::statuskepegawaian_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, StatusKepegawaian $statuskepegawaian)
	{
		$data['statuskepegawaian'] = $statuskepegawaian;

		
		$data['forms'] = array(
			'status_kepegawaian' => ['Status Kepegawaian', Form::text("status_kepegawaian", $statuskepegawaian->status_kepegawaian, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "status_kepegawaian"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$statuskepegawaian->what;
		$this->log($request, $text, ['statuskepegawaian.id' => $statuskepegawaian->id]);
		return view('StatusKepegawaian::statuskepegawaian_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_kepegawaian' => 'required',
			
		]);
		
		$statuskepegawaian = StatusKepegawaian::find($id);
		$statuskepegawaian->status_kepegawaian = $request->input("status_kepegawaian");
		
		$statuskepegawaian->updated_by = Auth::id();
		$statuskepegawaian->save();


		$text = 'mengedit '.$this->title;//.' '.$statuskepegawaian->what;
		$this->log($request, $text, ['statuskepegawaian.id' => $statuskepegawaian->id]);
		return redirect()->route('statuskepegawaian.index')->with('message_success', 'Status Kepegawaian berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$statuskepegawaian = StatusKepegawaian::find($id);
		$statuskepegawaian->deleted_by = Auth::id();
		$statuskepegawaian->save();
		$statuskepegawaian->delete();

		$text = 'menghapus '.$this->title;//.' '.$statuskepegawaian->what;
		$this->log($request, $text, ['statuskepegawaian.id' => $statuskepegawaian->id]);
		return back()->with('message_success', 'Status Kepegawaian berhasil dihapus!');
	}

}
