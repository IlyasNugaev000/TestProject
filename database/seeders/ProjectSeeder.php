<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::query()->create([
            'id' => Str::uuid(),
            'name' => 'First User Project',
            'description' => 'owner',
            'status' => 'В работе',
            'creator_id' => 1
        ]);

        /**
         *  Пользователь 1 - создатель проекта
         *  Пользователь 2 - участник проекта, с правами Полный доступ
         *  Пользователь 3 - участник проекта с правами Редактирование
         *  Пользователь 4 - участник проекта с правами Чтение
         *  Пользователь 5 - не состоит в проекте и следовательно доступ к проекту запрещён (не отображается в списке проектов)
         */

        //Первого пользователя пропускаем, так как он владелец, последнего пропускаем так как его нет в проекте

        /** @var User $secondUser */
        $secondUser = User::query()->where('id', 2)->first();

        $secondUser->foreignProjects()->attach($project->id, ['role_id' => Role::FULL_ACCESS]);

        /** @var User $thirdUser */
        $thirdUser = User::query()->where('id', 3)->first();

        $thirdUser->foreignProjects()->attach($project->id, ['role_id' => Role::EDIT_ACCESS]);

        /** @var User $fourthUser */
        $fourthUser = User::query()->where('id', 4)->first();

        $fourthUser->foreignProjects()->attach($project->id, ['role_id' => Role::READ_ACCESS]);
    }
}
