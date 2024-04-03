<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'id' => 1,
            'name' => 'Name1',
            'last_name' => 'LastName1',
            'email' => 'ilyas-nugaev1@mail.ru',
            'password' => Hash::make('password1'),
            'phone' => '79003295394',
            'email_verified_at' => now(),
            'last_auth_at' => now(),
        ]);

        User::query()->create([
            'id' => 2,
            'name' => 'Name2',
            'last_name' => 'LastName2',
            'email' => 'ilyas-nugaev2@mail.ru',
            'password' => Hash::make('password2'),
            'phone' => '79003295395',
            'email_verified_at' => now(),
            'last_auth_at' => now(),
        ]);

        User::query()->create([
            'id' => 3,
            'name' => 'Name3',
            'last_name' => 'LastName3',
            'email' => 'ilyas-nugaev3@mail.ru',
            'password' => Hash::make('password3'),
            'phone' => '79003295396',
            'email_verified_at' => now(),
            'last_auth_at' => now(),
        ]);

        User::query()->create([
            'id' => 4,
            'name' => 'Name4',
            'last_name' => 'LastName4',
            'email' => 'ilyas-nugaev4@mail.ru',
            'password' => Hash::make('password4'),
            'phone' => '79003295397',
            'email_verified_at' => now(),
            'last_auth_at' => now(),
        ]);

        User::query()->create([
            'id' => 5,
            'name' => 'Name5',
            'last_name' => 'LastName5',
            'email' => 'ilyas-nugaev5@mail.ru',
            'password' => Hash::make('password5'),
            'phone' => '79003295398',
            'email_verified_at' => now(),
            'last_auth_at' => now(),
        ]);
    }
}
