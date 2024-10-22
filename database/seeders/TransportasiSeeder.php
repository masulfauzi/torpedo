<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Transportasi\Models\Transportasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transportasi::create([
            'transportasi' => 'Jalan Kaki'
        ]);
        Transportasi::create([
            'transportasi' => 'Angkutan Umum'
        ]);
        Transportasi::create([
            'transportasi' => 'Mobil atau Bus Antar Jemput'
        ]);
        Transportasi::create([
            'transportasi' => 'Kereta Api'
        ]);
        Transportasi::create([
            'transportasi' => 'Ojek'
        ]);
        Transportasi::create([
            'transportasi' => 'Andong/Dokar/Delman/Becak'
        ]);
        Transportasi::create([
            'transportasi' => 'Perahu Penyeberangan/Rakit/Getek'
        ]);
        Transportasi::create([
            'transportasi' => 'Kuda'
        ]);
        Transportasi::create([
            'transportasi' => 'Sepeda'
        ]);
        Transportasi::create([
            'transportasi' => 'Sepeda Motor'
        ]);
        Transportasi::create([
            'transportasi' => 'Mobil Pribadi'
        ]);
    }
}
