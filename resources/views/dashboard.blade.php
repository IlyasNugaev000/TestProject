<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Projects') }}
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

                    <div class="mt-1 mb-4">
                        <x-primary-button>
                            <a href="{{ route('project.create') }}">{{ __('Add Project') }}</a>
                        </x-primary-button>
                    </div>
                    <div class="px-6 py-3">
                        Your projects
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </thead>
                            <tbody>
                            @foreach ($projects as $project)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('dashboard.project', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-3 mt-6">
                        Foreign projects
                    </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                </thead>
                                <tbody>
                                @foreach ($foreignProjects as $foreignProject)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('dashboard.project', ['id' => $foreignProject->id]) }}">{{ $foreignProject->name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>