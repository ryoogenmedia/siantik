<?php

namespace Database\Seeders;

use App\Models\Institution;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create("id_ID");

        // Path asli gambar di folder public/logo/
        $sourcePath = public_path('logo/tik-polri-logo.png');

        // Pastikan direktori storage/logo ada
        Storage::disk('public')->makeDirectory('logo');

        // Nama file unik untuk logo di storage
        $imageName = 'logo/' . uniqid() . '.png';
        $destinationPath = storage_path('app/public/' . $imageName);

        // Cek apakah file sumber ada, lalu salin ke storage
        if (File::exists($sourcePath)) {
            File::copy($sourcePath, $destinationPath);
        } else {
            $imageName = ""; // Jika tidak ada, gunakan default
        }

        Institution::create([
            'name'                 => $faker->company,
            'longitude'            => 119.5562,
            'latitude'             => -5.0823,
            'address'              => $faker->address,
            'time_check_in_start'  => $faker->time('H:i:s'),
            'time_check_in_end'    => $faker->time('H:i:s'),
            'time_check_out_start' => $faker->time('H:i:s'),
            'time_check_out_end'   => $faker->time('H:i:s'),
            'logo'                 => $imageName,
            'radius'               => $faker->numberBetween(100, 500),
        ]);
    }
}
