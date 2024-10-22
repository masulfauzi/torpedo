<?php

namespace Database\Seeders;

use App\Modules\TempatTinggal\Models\TempatTinggal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatTinggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TempatTinggal::create([
            'tempat_tinggal' => 'Bersama Orang Tua'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Wali'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Kost'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Asrama'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Panti Asuhan'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Pesantren'
        ]);
        TempatTinggal::create([
            'tempat_tinggal' => 'Lainnya'
        ]);
    }
}
