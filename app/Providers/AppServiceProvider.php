<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProjectRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-detail-page', function (User $user, string $projectId) {
            return $user->foreignProjects()->where('projects.id', $projectId)->exists()
                or $user->id === Project::query()->where('id', $projectId)->first()->creator_id;
        });

        Gate::define('owner', function (User $user, string $projectId) {
            return $user->id === Project::query()->where('id', $projectId)->first()->creator_id;
        });

        Gate::define('full-access', function (User $user, string $projectId) {
            return UserProjectRole::query()
                ->where('user_id', $user->id)
                ->where('project_id', $projectId)
                ->first()
                ?->role_id === Role::FULL_ACCESS;
        });

        Gate::define('edit-access', function (User $user, string $projectId) {
            return UserProjectRole::query()
                ->where('user_id', $user->id)
                ->where('project_id', $projectId)
                ->first()
                ?->role_id === Role::EDIT_ACCESS;
        });
    }
}
