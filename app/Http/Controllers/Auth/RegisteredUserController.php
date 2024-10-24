<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Modules\Sekolah\Models\Sekolah;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Modules\JenisSekolah\Models\JenisSekolah;
use App\Modules\StatusSekolah\Models\StatusSekolah;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['jenis_sekolah'] = JenisSekolah::all()->pluck('jenis_sekolah', 'id');
        $data['jenis_sekolah']->prepend('Pilih salah satu', '');
        $data['status_sekolah'] = StatusSekolah::all()->pluck('status_sekolah', 'id');
        $data['status_sekolah']->prepend('Pilih salah satu', '');
        return view('auth.register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->input('id_jenis_sekolah'));
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required'],
            'npsn' => ['required', 'string', 'unique:sekolah'],
            'nama_sekolah' => ['required'],
            'id_jenis_sekolah' => ['required'],
            'id_status_sekolah' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $sekolah = Sekolah::create([
        //     'id_jenis_sekolah' => $request->input('id_jenis_sekolah'),
        //     'id_status_sekolah' => $request->input('id_status_sekolah'),
        //     'nama_sekolah' => $request->input('nama_sekolah'),
        //     'npsn' => $request->input('npsn')
        // ]);

        // $jenisSekolah = JenisSekolah::create([
        //     'jenis_sekolah' => 'luar_negeri'
        // ]);

        $insert_sekolah = Sekolah::insert_sekolah($request);

        // dd($insert_sekolah);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_sekolah' => $insert_sekolah,
        ]);

        Sekolah::kirim_notif_wa($request->no_hp);

        
        event(new Registered($user));
        
        Sekolah::insert_role($user);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
