<?php

namespace App\Http\Controllers;

use App\Dto\Project\ProjectDeleteRequestData;
use App\Dto\Project\ProjectStoreRequestData;
use App\Dto\Project\ProjectUpdateRequestData;
use App\Dto\Project\UserCreateRequestData;
use App\Dto\Project\UserDeleteRequestData;
use App\Models\Project;
use App\Models\User;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function create(): View
    {
        return view('project.create');
    }

    public function store(
        ProjectStoreRequestData $requestData,
        ProjectRepositoryInterface $repository
    ): RedirectResponse {
        $repository->save(
            $requestData->name,
            $requestData->description,
            auth()->id()
        );

        return redirect()->route('dashboard.get')->with('status', 'Project created successfully');
    }

    public function deleteUser(
        UserDeleteRequestData $requestData,
        ProjectRepositoryInterface $repository
    ): RedirectResponse {
        if (! Gate::any(['owner', 'full-access'], $requestData->projectId)) {
            abort(403);
        }

        $repository->deleteUser($requestData->userId, $requestData->projectId);

        return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'User deleted successfully');
    }

    public function addUser(
        UserCreateRequestData $requestData,
        ProjectRepositoryInterface $repository
    ): RedirectResponse {
        if (! Gate::any(['owner', 'full-access'], $requestData->projectId)) {
            abort(403);
        }

        /** @var User|null $user */
        $user = $repository->getUserByEmail($requestData->userEmail);

        if (!$user) {
            return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'User not found');
        } elseif ($user->foreignProjects()->where('projects.id', $requestData->projectId)->exists()) {
            return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'User already added');
        } elseif ($user->id === Project::query()->where('id', $requestData->projectId)->first()->creator_id) {
            return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'You cant add owner');
        }

        $repository->addUserToProject($user, $requestData->projectId);

        return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'User added successfully');
    }

    public function update(
        ProjectUpdateRequestData $requestData,
        ProjectRepositoryInterface $repository
    ): RedirectResponse {
        if (! Gate::any(['owner', 'full-access', 'edit-access'], $requestData->projectId)) {
            abort(403);
        }

        $repository->update(
            $requestData->projectId,
            $requestData->name,
            $requestData->description,
            $requestData->status
        );

        return redirect()->route('dashboard.project', ['id' => $requestData->projectId])->with('status', 'Project updated successfully');
    }

    public function delete(
        ProjectDeleteRequestData $requestData,
        ProjectRepositoryInterface $repository
    ): RedirectResponse {
        Gate::authorize('owner', $requestData->projectId);

        $repository->deleteProjectById($requestData->projectId);

        return redirect()->route('dashboard.get')->with('status', 'Project deleted successfully');
    }
}
