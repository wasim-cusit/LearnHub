<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Learning Task') }}
            </h2>
            <a href="{{ route('learning-tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('learning-tasks.store') }}" class="space-y-6">
                        @csrf

                        <!-- Task Title -->
                        <div>
                            <x-input-label for="title" :value="__('Task Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="e.g., Install Laravel and set up development environment" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Brief Description')" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Brief description of what needs to be done..." required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Detailed Description -->
                        <div>
                            <x-input-label for="detailed_description" :value="__('Detailed Description (Optional)')" />
                            <textarea id="detailed_description" name="detailed_description" rows="6" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Step-by-step instructions, concepts to learn, etc...">{{ old('detailed_description') }}</textarea>
                            <x-input-error :messages="$errors->get('detailed_description')" class="mt-2" />
                        </div>

                        <!-- Phase and Category -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="phase" :value="__('Learning Phase')" />
                                <select id="phase" name="phase" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Phase</option>
                                    @foreach($phases as $key => $phase)
                                        <option value="{{ $key }}" {{ old('phase') == $key ? 'selected' : '' }}>{{ $phase }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('phase')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Priority and Order -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }} selected>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="estimated_hours" :value="__('Estimated Hours')" />
                                <x-text-input id="estimated_hours" class="block mt-1 w-full" type="number" name="estimated_hours" :value="old('estimated_hours')" min="1" placeholder="e.g., 2" />
                                <x-input-error :messages="$errors->get('estimated_hours')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="order_in_phase" :value="__('Order in Phase')" />
                                <x-text-input id="order_in_phase" class="block mt-1 w-full" type="number" name="order_in_phase" :value="old('order_in_phase', 0)" min="0" />
                                <x-input-error :messages="$errors->get('order_in_phase')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Due Date and Milestone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="due_date" :value="__('Due Date (Optional)')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>

                            <div class="flex items-center mt-6">
                                <input id="is_milestone" type="checkbox" name="is_milestone" value="1" {{ old('is_milestone') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <label for="is_milestone" class="ml-2 block text-sm text-gray-900">
                                    This is a milestone task
                                </label>
                            </div>
                        </div>

                        <!-- Resources -->
                        <div>
                            <x-input-label for="resources" :value="__('Resources (Optional)')" />
                            <div id="resources-container">
                                <div class="flex space-x-2 mb-2">
                                    <input type="url" name="resources[]" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="https://laravel.com/docs/...">
                                    <button type="button" onclick="addResource()" class="bg-green-500 hover:bg-green-700 text-white px-3 py-2 rounded-lg">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Add links to documentation, videos, or other learning resources</p>
                        </div>

                        <!-- Notes -->
                        <div>
                            <x-input-label for="notes" :value="__('Notes (Optional)')" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Additional notes, tips, or reminders...">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="bg-blue-500 hover:bg-blue-700">
                                <i class="fas fa-plus mr-2"></i>{{ __('Create Learning Task') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- JavaScript for dynamic resource fields -->
    <script>
        function addResource() {
            const container = document.getElementById('resources-container');
            const newResource = document.createElement('div');
            newResource.className = 'flex space-x-2 mb-2';
            newResource.innerHTML = `
                <input type="url" name="resources[]" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="https://laravel.com/docs/...">
                <button type="button" onclick="removeResource(this)" class="bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded-lg">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newResource);
        }

        function removeResource(button) {
            button.parentElement.remove();
        }
    </script>
</x-app-layout>
