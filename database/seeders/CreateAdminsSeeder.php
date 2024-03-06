<?php

namespace Database\Seeders;

use App\Enums\UserGender;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'baxodirov0609@gmail.com'
        ], [
            'name' => 'Akmal',
            'phone' => '+998882019909',
            'phone_verified_at' => '15.09.2023 17:13',
            'status' => UserStatus::ACTIVE,
            'gender' => UserGender::MALE,
            'date_of_birth' => '09.06.1999',
            'password' => Hash::make('MyPass01'),
        ]);

        User::firstOrCreate([
            'email' => 'aizekjon@gmail.com'
        ], [
            'name' => 'Aizek',
            'phone' => '+998995051704',
            'phone_verified_at' => '15.09.2023 17:13',
            'status' => UserStatus::ACTIVE,
            'gender' => UserGender::MALE,
            'date_of_birth' => '17.04.1999',
            'password' => Hash::make('MyPass01'),
        ]);
    }
}
