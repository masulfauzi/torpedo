<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Modules\Desa\Models\Desa;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\MapelSeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\MenuTableSeeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UsersTableSeeder;
use App\Modules\Sekolah\Models\Sekolah;
use Database\Seeders\JenisKelaminSeeder;
use Database\Seeders\TransportasiSeeder;
use App\Modules\Provinsi\Models\Provinsi;
use Database\Seeders\TempatTinggalSeeder;
use Database\Seeders\UserRoleTableSeeder;
use Database\Seeders\PrivilegeTableSeeder;
use App\Modules\Kabupaten\Models\Kabupaten;
use App\Modules\Kecamatan\Models\Kecamatan;
use App\Modules\JenisSekolah\Models\JenisSekolah;
use App\Modules\StatusSekolah\Models\StatusSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Provinsi::create([
            'nama_provinsi' => 'Jawa Tengah'
        ]);

        $provinsi = Provinsi::whereNamaProvinsi('Jawa Tengah')->first();

        Kabupaten::create([
            'id_provinsi' => $provinsi->id,
            'nama_kabupaten' => 'Kota Semarang'
        ]);

        $kabupaten = Kabupaten::whereNamaKabupaten('Kota Semarang')->first();

        Kecamatan::create([
            'id_kabupaten' => $kabupaten->id,
            'nama_kecamatan' => 'Semarang Timur'
        ]);

        $kecamatan = Kecamatan::whereNamaKecamatan('Semarang Timur')->first();

        Desa::create([
            'id_kecamatan' => $kecamatan->id,
            'nama_desa' => 'Karangturi',
        ]);

        JenisSekolah::create([
            'jenis_sekolah' => 'SD'
        ]);

        JenisSekolah::create([
            'jenis_sekolah' => 'SMP'
        ]);

        JenisSekolah::create([
            'jenis_sekolah' => 'SMK'
        ]);

        $jenisSekolah = JenisSekolah::whereJenisSekolah('SMK')->first();

        StatusSekolah::create([
            'status_sekolah' => 'Negeri'
        ]);
        StatusSekolah::create([
            'status_sekolah' => 'Swasta'
        ]);

        $statusSekolah = StatusSekolah::whereStatusSekolah('Negeri')->first();
        $desa = Desa::whereNamaDesa('Karangturi')->first();

        Sekolah::create([
            'id_jenis_sekolah' => $jenisSekolah->id,
            'id_status_sekolah' => $statusSekolah->id,
            'nama_sekolah' => 'SMKN 2 Semarang',
            'npsn' => '20328970',
            'alamat' => 'Jl. Dr Cipto no. 121A',
            'id_desa' => $desa->id,
        ]);

        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PrivilegeTableSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(TempatTinggalSeeder::class);
        $this->call(TransportasiSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(MapelSeeder::class);
    }
}
