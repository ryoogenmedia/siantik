<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $users = User::where('roles', 'personil')->pluck('id')->toArray();

        if (empty($users)) {
            $this->command->info('Tidak ada user dengan peran personil.');
            return;
        }

        foreach ($users as $i) {
            Attendance::create([
                'user_id'            => $faker->randomElement($users),
                'name'               => $faker->name,
                'check_in'           => $faker->dateTimeBetween('-1 week', 'now'),
                'check_out'          => $faker->optional()->dateTimeBetween('now', '+1 week'),
                'status_attendance'  => $faker->randomElement(['hadir', 'alpa']),
                'status_check_in'    => $faker->randomElement(['tepat waktu', 'terlambat']),
                'status_check_out'   => $faker->randomElement(['tepat waktu', 'terlambat']),
                'longitude'          => 119.5562,
                'latitude'           => -5.0823,
            ]);
        }
    }
}
