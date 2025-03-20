<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\User;
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
                'username'          => 'leader',
                'name'              => 'Pimpinan Personil',
                'phone_number'      => '0340340390',
                'roles'             => 'leader',
                'email'             => 'leader@mail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('leader123'),
            ]
        ];

        foreach ($leaders as $leader) {
            $akun = User::create($leader);
        }

        $personnels = [
            [
                'username'          => 'personil',
                'name'              => 'Personil',
                'phone_number'      => '0340340390',
                'roles'             => 'personil',
                'email'             => 'personil@mail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('personil123'),
            ],
        ];

        foreach ($personnels as $personel) {
            $akun = User::create($personel);

            Personnel::create([
                'user_id'         => $akun->id,
                'name'            => $akun->name,
                'number_identity' => '99304934',
                'position'        => '999343',
                'sex'             => 'laki-laki',
            ]);
        }

        $admins = [
            [
                'username'          => 'admin',
                'name'              => 'Akun Admin',
                'phone_number'      => '398498394',
                'roles'             => 'admin',
                'email'             => 'admin@mail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('admin123'),
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        $super_admins = [
            [
                'username'          => 'muh_bintang_ramli',
                'name'              => 'Muhammad Bintang Ramli',
                'phone_number'      => '0886346736473',
                'roles'             => 'superadmin',
                'email'             => 'muhbintang650@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bintang123'),
            ],
            [
                'username'          => 'fery_fadul_rahman',
                'name'              => 'Fery Fadul Rahman',
                'phone_number'      => '07384783748',
                'roles'             => 'superadmin',
                'email'             => 'feryfadulrahman@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('fery123'),
            ],
            [
                'username'          => 'superadmin',
                'name'              => 'Akun Super Admin',
                'phone_number'      => '374837773',
                'roles'             => 'superadmin',
                'email'             => 'superadmin@mail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('superadmin123'),
            ],
        ];

        foreach ($super_admins as $super_admin) {
            User::create($super_admin);
        }
    }
}
