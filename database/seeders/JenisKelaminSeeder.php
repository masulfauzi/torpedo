<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\JenisKelamin\Models\JenisKelamin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKelamin::create([
            'jenis_kelamin' => 'Laki-Laki'
        ]);
        JenisKelamin::create([
            'jenis_kelamin' => 'Perempuan'
        ]);
    }
}
