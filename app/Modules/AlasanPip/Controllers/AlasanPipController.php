<?php
namespace App\Modules\AlasanPip\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\AlasanPip\Models\AlasanPip;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlasanPipController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Alasan Pip";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = AlasanPip::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('AlasanPip::alasanpip', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'alasan_pip' => ['Alasan Pip', Form::text("alasan_pip", old("alasan_pip"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('AlasanPip::alasanpip_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'alasan_pip' => 'required',
			
		]);

		$alasanpip = new AlasanPip();
		$alasanpip->alasan_pip = $request->input("alasan_pip");
		
		$alasanpip->created_by = Auth::id();
		$alasanpip->save();

		$text = 'membuat '.$this->title; //' baru '.$alasanpip->what;
		$this->log($request, $text, ['alasanpip.id' => $alasanpip->id]);
		return redirect()->route('alasanpip.index')->with('message_success', 'Alasan Pip berhasil ditambahkan!');
	}

	public function show(Request $request, AlasanPip $alasanpip)
	{
		$data['alasanpip'] = $alasanpip;

		$text = 'melihat detail '.$this->title;//.' '.$alasanpip->what;
		$this->log($request, $text, ['alasanpip.id' => $alasanpip->id]);
		return view('AlasanPip::alasanpip_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, AlasanPip $alasanpip)
	{
		$data['alasanpip'] = $alasanpip;

		
		$data['forms'] = array(
			'alasan_pip' => ['Alasan Pip', Form::text("alasan_pip", $alasanpip->alasan_pip, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "alasan_pip"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$alasanpip->what;
		$this->log($request, $text, ['alasanpip.id' => $alasanpip->id]);
		return view('AlasanPip::alasanpip_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'alasan_pip' => 'required',
			
		]);
		
		$alasanpip = AlasanPip::find($id);
		$alasanpip->alasan_pip = $request->input("alasan_pip");
		
		$alasanpip->updated_by = Auth::id();
		$alasanpip->save();


		$text = 'mengedit '.$this->title;//.' '.$alasanpip->what;
		$this->log($request, $text, ['alasanpip.id' => $alasanpip->id]);
		return redirect()->route('alasanpip.index')->with('message_success', 'Alasan Pip berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$alasanpip = AlasanPip::find($id);
		$alasanpip->deleted_by = Auth::id();
		$alasanpip->save();
		$alasanpip->delete();

		$text = 'menghapus '.$this->title;//.' '.$alasanpip->what;
		$this->log($request, $text, ['alasanpip.id' => $alasanpip->id]);
		return back()->with('message_success', 'Alasan Pip berhasil dihapus!');
	}

}
