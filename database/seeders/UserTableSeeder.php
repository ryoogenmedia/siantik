<?php

namespace Database\Seeders;

use App\Models\Leader;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaders = [
            [
                'username' => 'leader',
                'name' => 'Leader',
                'phone_number' => '0340340390',
                'roles' => 'leader',
                'email' => 'leader@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('leader'),
            ]
        ];

        foreach($leaders as $leader){
            $akun = User::create($leader);

            Leader::create([
                'user_id' => $akun->id,
                'name' => $akun->name,
                'address' => 'Jl Perintis Kemerdekaan KM 18',
                'sex' => 'laki-laki',
            ]);
        }

        $personnels = [
            [
                'username' => 'personnel',
                'name' => 'Personnel',
                'phone_number' => '0340340390',
                'roles' => 'personnel',
                'email' => 'personnel@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('personnel123'),
            ],
        ];

        foreach($personnels as $personel){
            $akun = User::create($personel);

            Personnel::create([
                'user_id' => $akun->id,
                'name' => $akun->name,
                'nip' => '99304934',
                'nrp' => '888353',
                'position' => '999343',
                'sex' => 'laki-laki',
            ]);
        }

        $admins = [
            [
                'username' => 'admin',
                'name' => 'Admin',
                'phone_number' => '398498394',
                'roles' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'),
            ]
        ];

        foreach($admins as $admin){
            User::create($admin);
        }

        $super_admins = [
            [
                'username' => 'muh_bintang_ramli',
                'name' => 'Muhammad Bintang Ramli',
                'phone_number' => '0886346736473',
                'roles' => 'superadmin',
                'email' => 'muhbintang650@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('bintang123'),
            ],
            [
                'username' => 'fery_fadul_rahman',
                'name' => 'Fery Fadul Rahman',
                'phone_number' => '07384783748',
                'roles' => 'superadmin',
                'email' => 'feryfadulrahman@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('fery123'),
            ],
        ];

        foreach($super_admins as $super_admin){
            User::create($super_admin);
        }
    }
}
