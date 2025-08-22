<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Form',
                'email_verified_at' => now(),
                'password' => Hash::make('90909090'),
                'tipe_pengguna' => 'Admin',
                'telepon' => '08123456789',
                'bio' => '-',
                'gambar' => '1.jpg',
                'remember_token' => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'unga@gmail.com'],
            [
                'name' => 'Unga',
                'email_verified_at' => now(),
                'password' => Hash::make('1717171717'),
                'tipe_pengguna' => 'Klien',
                'telepon' => '08123456788',
                'bio' => '-',
                'gambar' => '2.jpg',
                'remember_token' => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'ehsan@gmail.com'],
            [
                'name' => 'Ehsan',
                'email_verified_at' => now(),
                'password' => Hash::make('00000000'),
                'tipe_pengguna' => 'Freelancer',
                'telepon' => '08123456787',
                'bio' => 'Freelancer sukses ibu kota',
                'gambar' => '3.jpg',
                'remember_token' => Str::random(10),
            ]
        );
    }
}
