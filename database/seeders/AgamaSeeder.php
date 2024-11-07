<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Agama\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agama::create([
            'agama' => 'Islam'
        ]);
        Agama::create([
            'agama' => 'Kristen'
        ]);
        Agama::create([
            'agama' => 'Katholik'
        ]);
        Agama::create([
            'agama' => 'Hindu'
        ]);
        Agama::create([
            'agama' => 'Buddha'
        ]);
        Agama::create([
            'agama' => 'Khonghucu'
        ]);
    }
}
