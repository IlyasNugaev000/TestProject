<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface ProjectRepositoryInterface
{
    public function save(string $name, string $description, int $userId): void;
    public function update(string $projectId, string $name, string $description, string $status): void;
    public function getCreatedProjectsByUser(User $user): iterable;
    public function getForeignProjectsByUser(User $user): iterable;
    public function getProjectById(string $projectId): Model;
    public function deleteUser(int $userId, string $projectId): void;
    public function addUserToProject(User $user, string $projectId): void;
    public function getUserByEmail(string $userEmail): ?Model;
    public function deleteProjectById(string $projectId): void;
}