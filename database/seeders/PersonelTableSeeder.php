<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PersonelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 100) as $i) {
            $user = User::create([
                'username'          => $faker->userName,
                'name'              => $faker->name,
                'phone_number'      => $faker->phoneNumber,
                'roles'             => 'personil',
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password'          => bcrypt('personil123'),
            ]);

            Personnel::create([
                'user_id'         => $user->id,
                'name'            => $user->name,
                'position'        => $faker->jobTitle,
                'number_identity' => $faker->unique()->numerify('##########'),
                'sex'             => $faker->randomElement(['male', 'female']),
            ]);
        }
    }
}
