<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->insert([
            'id' => 1,
            'slug' => 'full-access',
            'description' => 'Полный доступ'
        ]);

        Role::query()->insert([
            'id' => 2,
            'slug' => 'edit-access',
            'description' => 'Доступ на редактирование'
        ]);

        Role::query()->insert([
            'id' => 3,
            'slug' => 'read-access',
            'description' => 'Доступ на чтение'
        ]);
    }
}
