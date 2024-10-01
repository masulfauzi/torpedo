<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'Super Admin',
            'level' => 1
        ]);
        Role::create([
            'role' => 'Admin',
            'level' => 2
        ]);
        Role::create([
            'role' => 'Operator Sekolah',
            'level' => 3
        ]);
        Role::create([
            'role' => 'Guru',
            'level' => 3
        ]);
        Role::create([
            'role' => 'Wakil Kepala Sekolah',
            'level' => 3
        ]);
        Role::create([
            'role' => 'Siswa',
            'level' => 3
        ]);
        Role::create([
            'role' => 'BK',
            'level' => 3
        ]);

        Role::create([
            'role' => 'Kepala Sekolah',
            'level' => 3
        ]);

        Role::create([
            'role' => 'Wali Murid',
            'level' => 3
        ]);
    }
}
