<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Semester\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'semester' => 'Gasal 2024/2025',
            'kode_semester' => '20241',
            'tgl_mulai' => '2024-07-01',
            'tgl_selesai' => '2024-12-31',
            'urutan' => 1,
            'is_active' => 1
        ]);
    }
}
