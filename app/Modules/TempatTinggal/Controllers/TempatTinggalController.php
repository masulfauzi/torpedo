<?php
namespace App\Modules\TempatTinggal\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\TempatTinggal\Models\TempatTinggal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TempatTinggalController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Tempat Tinggal";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = TempatTinggal::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('TempatTinggal::tempattinggal', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'tempat_tinggal' => ['Tempat Tinggal', Form::text("tempat_tinggal", old("tempat_tinggal"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('TempatTinggal::tempattinggal_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'tempat_tinggal' => 'required',
			
		]);

		$tempattinggal = new TempatTinggal();
		$tempattinggal->tempat_tinggal = $request->input("tempat_tinggal");
		
		$tempattinggal->created_by = Auth::id();
		$tempattinggal->save();

		$text = 'membuat '.$this->title; //' baru '.$tempattinggal->what;
		$this->log($request, $text, ['tempattinggal.id' => $tempattinggal->id]);
		return redirect()->route('tempattinggal.index')->with('message_success', 'Tempat Tinggal berhasil ditambahkan!');
	}

	public function show(Request $request, TempatTinggal $tempattinggal)
	{
		$data['tempattinggal'] = $tempattinggal;

		$text = 'melihat detail '.$this->title;//.' '.$tempattinggal->what;
		$this->log($request, $text, ['tempattinggal.id' => $tempattinggal->id]);
		return view('TempatTinggal::tempattinggal_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, TempatTinggal $tempattinggal)
	{
		$data['tempattinggal'] = $tempattinggal;

		
		$data['forms'] = array(
			'tempat_tinggal' => ['Tempat Tinggal', Form::text("tempat_tinggal", $tempattinggal->tempat_tinggal, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "tempat_tinggal"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$tempattinggal->what;
		$this->log($request, $text, ['tempattinggal.id' => $tempattinggal->id]);
		return view('TempatTinggal::tempattinggal_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'tempat_tinggal' => 'required',
			
		]);
		
		$tempattinggal = TempatTinggal::find($id);
		$tempattinggal->tempat_tinggal = $request->input("tempat_tinggal");
		
		$tempattinggal->updated_by = Auth::id();
		$tempattinggal->save();


		$text = 'mengedit '.$this->title;//.' '.$tempattinggal->what;
		$this->log($request, $text, ['tempattinggal.id' => $tempattinggal->id]);
		return redirect()->route('tempattinggal.index')->with('message_success', 'Tempat Tinggal berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$tempattinggal = TempatTinggal::find($id);
		$tempattinggal->deleted_by = Auth::id();
		$tempattinggal->save();
		$tempattinggal->delete();

		$text = 'menghapus '.$this->title;//.' '.$tempattinggal->what;
		$this->log($request, $text, ['tempattinggal.id' => $tempattinggal->id]);
		return back()->with('message_success', 'Tempat Tinggal berhasil dihapus!');
	}

}
