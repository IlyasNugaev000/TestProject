<?php

namespace App\Repositories\Contracts;

use App\Models\Project;

interface UserRepositoryInterface
{
    public function getUsersByProject(Project $project): iterable;
}