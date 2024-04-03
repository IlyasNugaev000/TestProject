<?php

namespace App\Repositories;

use App\Enums\ProjectStatusEnum;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function save(
        string $name,
        string $description,
        int $userId,
        ?string $status = ProjectStatusEnum::IN_PROGRESS->value
    ): void {
        Project::query()->create([
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'creator_id' => $userId
        ]);
    }

    public function update(string $projectId, string $name, string $description, string $status): void
    {
        Project::query()->where('id', $projectId)->update([
            'name' => $name,
            'description' => $description,
            'status' => $status
        ]);
    }

    public function getCreatedProjectsByUser(User $user): Collection
    {
        return $user->ownerProjects;
    }

    public function getForeignProjectsByUser(User $user): Collection
    {
        return $user->foreignProjects;
    }

    public function getProjectById(string $projectId): Model
    {
        return Project::query()->where('id', $projectId)->first();
    }

    public function deleteUser(int $userId, string $projectId): void
    {
        /** @var User $user */
        $user = User::query()->where('id', $userId)->first();

        $user->foreignProjects()->detach($projectId);
    }

    public function addUserToProject(User $user, string $projectId): void
    {
        $user?->foreignProjects()->attach($projectId, ['role_id' => Role::READ_ACCESS]);
    }

    public function getUserByEmail(string $userEmail): ?Model
    {
        return User::query()->where('email', $userEmail)->first();
    }

    public function deleteProjectById(string $projectId): void
    {
        Project::query()->where('id', $projectId)->delete();
    }
}