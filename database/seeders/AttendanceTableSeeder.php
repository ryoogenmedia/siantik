<?php

namespace Database\Seeders;

use App\Models\{Attendance, CheckIn, CheckOut, Institution, Permission, User};
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::where('roles', 'personil')->pluck('id');
        $institution = Institution::first(['id', 'longitude', 'latitude']);
        $permission_status = ['sakit', 'cuti', 'izin', 'tugas', 'pendidikan'];

        foreach ($userIds as $userId) {
            foreach (config('const.category_attendance') as $status_attendance) {
                $attendance = Attendance::create([
                    'user_id' => $userId,
                    'status_attendance' => $status_attendance
                ]);

                if (in_array($status_attendance, $permission_status)) {
                    Permission::create([
                        'user_id' => $userId,
                        'status_permission' => $attendance->status_attendance,
                        'information' => $faker->sentence(),
                        'date_start' => Carbon::today()->toDateString(),
                        'date_end' => Carbon::today()->addWeek()->toDateString(),
                    ]);

                    $attendance->update(['is_permission' => true]);
                } else {
                    $checkIn = CheckIn::create([
                        'user_id' => $userId,
                        'status' => true,
                        'longitude' => $institution->longitude,
                        'latitude' => $institution->latitude,
                    ]);

                    $checkOut = CheckOut::create([
                        'user_id' => $userId,
                        'status' => true,
                        'longitude' => $institution->longitude,
                        'latitude' => $institution->latitude,
                    ]);

                    $attendance->update([
                        'check_in_id' => $checkIn->id,
                        'check_out_id' => $checkOut->id,
                        'is_permission' => false,
                    ]);
                }
            }
        }
    }
}
