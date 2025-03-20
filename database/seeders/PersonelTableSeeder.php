<?php

namespace Database\Seeders;

use App\Models\Personnel;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 20) as $i) {
            Personnel::create([
                'user_id',
                'name',
                'position',
                'number_identity',
                'sex',
            ]);
        }
    }
}
