<?php
namespace App\Modules\AlasanTolakKip\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\AlasanTolakKip\Models\AlasanTolakKip;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlasanTolakKipController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Alasan Tolak Kip";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = AlasanTolakKip::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('AlasanTolakKip::alasantolakkip', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'alasan_tolak_kip' => ['Alasan Tolak Kip', Form::text("alasan_tolak_kip", old("alasan_tolak_kip"), ["class" => "form-control","placeholder" => "", "required" => "required"]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('AlasanTolakKip::alasantolakkip_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'alasan_tolak_kip' => 'required',
			
		]);

		$alasantolakkip = new AlasanTolakKip();
		$alasantolakkip->alasan_tolak_kip = $request->input("alasan_tolak_kip");
		
		$alasantolakkip->created_by = Auth::id();
		$alasantolakkip->save();

		$text = 'membuat '.$this->title; //' baru '.$alasantolakkip->what;
		$this->log($request, $text, ['alasantolakkip.id' => $alasantolakkip->id]);
		return redirect()->route('alasantolakkip.index')->with('message_success', 'Alasan Tolak Kip berhasil ditambahkan!');
	}

	public function show(Request $request, AlasanTolakKip $alasantolakkip)
	{
		$data['alasantolakkip'] = $alasantolakkip;

		$text = 'melihat detail '.$this->title;//.' '.$alasantolakkip->what;
		$this->log($request, $text, ['alasantolakkip.id' => $alasantolakkip->id]);
		return view('AlasanTolakKip::alasantolakkip_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, AlasanTolakKip $alasantolakkip)
	{
		$data['alasantolakkip'] = $alasantolakkip;

		
		$data['forms'] = array(
			'alasan_tolak_kip' => ['Alasan Tolak Kip', Form::text("alasan_tolak_kip", $alasantolakkip->alasan_tolak_kip, ["class" => "form-control","placeholder" => "", "required" => "required", "id" => "alasan_tolak_kip"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$alasantolakkip->what;
		$this->log($request, $text, ['alasantolakkip.id' => $alasantolakkip->id]);
		return view('AlasanTolakKip::alasantolakkip_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'alasan_tolak_kip' => 'required',
			
		]);
		
		$alasantolakkip = AlasanTolakKip::find($id);
		$alasantolakkip->alasan_tolak_kip = $request->input("alasan_tolak_kip");
		
		$alasantolakkip->updated_by = Auth::id();
		$alasantolakkip->save();


		$text = 'mengedit '.$this->title;//.' '.$alasantolakkip->what;
		$this->log($request, $text, ['alasantolakkip.id' => $alasantolakkip->id]);
		return redirect()->route('alasantolakkip.index')->with('message_success', 'Alasan Tolak Kip berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$alasantolakkip = AlasanTolakKip::find($id);
		$alasantolakkip->deleted_by = Auth::id();
		$alasantolakkip->save();
		$alasantolakkip->delete();

		$text = 'menghapus '.$this->title;//.' '.$alasantolakkip->what;
		$this->log($request, $text, ['alasantolakkip.id' => $alasantolakkip->id]);
		return back()->with('message_success', 'Alasan Tolak Kip berhasil dihapus!');
	}

}
