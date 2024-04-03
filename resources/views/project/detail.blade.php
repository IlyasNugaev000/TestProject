<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session()->has('status'))
                        <div class="flex justify-center items-center">
                            <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
                        </div>
                    @endif
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700">Name</span>
                            <span class="block w-full mt-1 rounded-md">{{$project->name}}</span>
                        </label>
                    </div>
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700">Description</span>
                            <span class="block w-full mt-1 rounded-md">{{$project->description}}</span>
                        </label>
                    </div>
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700">Status</span>
                            <span class="block w-full mt-1 rounded-md">{{$project->status}}</span>
                        </label>
                    </div>
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700">Users</span>
                            @foreach($users as $user)
                                <span class="block w-full mt-1 rounded-md">{{$user->name . ' ' . $user->last_name}}</span>
                                @canany(['owner', 'full-access'], $project->id)
                                    <form method="post" action="{{route('project.user.delete')}}" class="p-6">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <x-danger-button type="submit">
                                            Delete user
                                        </x-danger-button>
                                    </form>
                                @endcanany
                            @endforeach
                        </label>
                        @canany(['owner', 'full-access'], $project->id)
                            <form method="post" action="{{route('project.user.add')}}" class="p-6">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <label>
                                    <input name="user_email" placeholder="email">
                                </label>
                                <x-primary-button type="submit">
                                    Add user
                                </x-primary-button>
                            </form>
                        @endcanany
                    </div>
                        @canany(['owner', 'full-access', 'edit-access'], $project->id)
                        <x-primary-button>
                            <a href="{{ route('dashboard.project.edit', ['id' => $project->id]) }}">{{ __('Edit') }}</a>
                        </x-primary-button>
                        @endcanany
                        @can('owner', $project->id)
                            <form method="post" action="{{ route('project.delete') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <x-danger-button type="submit">
                                    Delete
                                </x-danger-button>
                            </form>
                        @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>