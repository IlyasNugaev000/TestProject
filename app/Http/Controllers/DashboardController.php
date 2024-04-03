<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatusEnum;
use App\Models\Project;
use App\Models\User;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(ProjectRepositoryInterface $projectRepository): View
    {
        /** @var User $user */
        $user = auth()->user();

        $projects = $projectRepository->getCreatedProjectsByUser($user);
        $foreignProjects = $projectRepository->getForeignProjectsByUser($user);

        return view('dashboard', compact('projects', 'foreignProjects'));
    }

    public function detail(
        string $projectId,
        ProjectRepositoryInterface $projectRepository,
        UserRepositoryInterface $userRepository
    ): View {
        Gate::authorize('view-detail-page', $projectId);

        /** @var Project $project */
        $project = $projectRepository->getProjectById($projectId);

        $users = $userRepository->getUsersByProject($project);

        return view('project.detail', compact('project', 'users'));
    }

    public function edit(
        string $projectId,
        ProjectRepositoryInterface $projectRepository,
        UserRepositoryInterface $userRepository
    ): View {
        if (! Gate::any(['owner', 'full-access', 'edit-access'], $projectId)) {
            abort(403);
        }

        /** @var Project $project */
        $project = $projectRepository->getProjectById($projectId);

        $statuses = array_column(ProjectStatusEnum::cases(), 'value');

        return view('project.edit', compact('project', 'statuses'));
    }
}
