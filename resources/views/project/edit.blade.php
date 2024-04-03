<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('project.update') }}">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Name</span>
                                <input type="text" name="name" class="block w-full mt-1 rounded-md" placeholder=""
                                       value="{{ old('name', $project->name) }}" />
                            </label>
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Description</span>
                                <textarea id="editor" class="block w-full mt-1 rounded-md" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                            </label>
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Status</span>
                                <select name="status">
                                    @foreach($statuses as $status)
                                        <option>{{$status}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <x-primary-button type="submit">
                            Save
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>