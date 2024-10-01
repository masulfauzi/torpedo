<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Users\Models\Users;
use App\Modules\Sekolah\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sekolah = Sekolah::first();
        Users::create([
            'name' => 'Super Admin',
            'id_sekolah' => $sekolah->id,
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
