<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Mapel\Models\Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mapel::create([
            'nama_mapel' => 'Matematika'
        ]);
        Mapel::create([
            'nama_mapel' => 'Bahasa Inggris'
        ]);
        Mapel::create([
            'nama_mapel' => 'Bahasa Indonesia'
        ]);
        Mapel::create([
            'nama_mapel' => 'PPKN'
        ]);
        Mapel::create([
            'nama_mapel' => 'Fisika'
        ]);
        Mapel::create([
            'nama_mapel' => 'Biologi'
        ]);
        Mapel::create([
            'nama_mapel' => 'Kimia'
        ]);
        Mapel::create([
            'nama_mapel' => 'PAI'
        ]);
        Mapel::create([
            'nama_mapel' => 'PJOK'
        ]);
        Mapel::create([
            'nama_mapel' => 'Prakarya dan Kewirausahaan'
        ]);
        Mapel::create([
            'nama_mapel' => 'Seni Budaya'
        ]);
    }
}
