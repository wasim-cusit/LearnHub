<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laravel Learning Roadmap') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('learning-tasks.dashboard') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-chart-line mr-2"></i>Progress Dashboard
                </a>
                <a href="{{ route('learning-tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Task
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                    <form method="GET" action="{{ route('learning-tasks.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="phase" class="block text-sm font-medium text-gray-700 mb-1">Phase</label>
                            <select id="phase" name="phase" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Phases</option>
                                @foreach($phases as $key => $phase)
                                    <option value="{{ $key }}" {{ request('phase') == $key ? 'selected' : '' }}>{{ $phase }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" name="category" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $key => $category)
                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Status</option>
                                <option value="not_started" {{ request('status') == 'not_started' ? 'selected' : '' }}>Not Started</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            </select>
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select id="priority" name="priority" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Priorities</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>Critical</option>
                            </select>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Filter
                            </button>
                            <a href="{{ route('learning-tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tasks by Phase -->
            @php
                $groupedTasks = $tasks->groupBy('phase');
            @endphp

            @foreach($groupedTasks as $phase => $phaseTasks)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $phases[$phase] ?? ucfirst($phase) }}</h3>
                            <div class="text-sm text-gray-500">
                                {{ $phaseTasks->where('status', 'completed')->count() }} of {{ $phaseTasks->count() }} completed
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach($phaseTasks->sortBy('order_in_phase') as $task)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-2">
                                                @if($task->is_milestone)
                                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                                                        <i class="fas fa-star mr-1"></i>Milestone
                                                    </span>
                                                @endif
                                                <h4 class="text-lg font-medium text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                    {{ $task->title }}
                                                </h4>
                                            </div>

                                            <p class="text-gray-600 mb-3">{{ $task->description }}</p>

                                            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                                                <span class="px-2 py-1 rounded-full
                                                    @if($task->priority === 'critical') bg-red-100 text-red-800
                                                    @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                    @else bg-green-100 text-green-800
                                                    @endif">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                                <span class="px-2 py-1 rounded-full
                                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                    @elseif($task->status === 'reviewed') bg-purple-100 text-purple-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full">
                                                    {{ $categories[$task->category] ?? ucfirst($task->category) }}
                                                </span>
                                                @if($task->estimated_hours)
                                                    <span><i class="fas fa-clock mr-1"></i>{{ $task->estimated_hours }}h</span>
                                                @endif
                                                @if($task->due_date)
                                                    <span class="{{ $task->isOverdue() ? 'text-red-600 font-medium' : '' }}">
                                                        <i class="fas fa-calendar mr-1"></i>{{ $task->due_date->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>

                                            @if($task->detailed_description)
                                                <div class="bg-gray-50 p-3 rounded-lg mb-3">
                                                    <h5 class="font-medium text-gray-900 mb-2">Detailed Description:</h5>
                                                    <p class="text-gray-700 text-sm">{{ $task->detailed_description }}</p>
                                                </div>
                                            @endif

                                            @if($task->resources)
                                                <div class="bg-blue-50 p-3 rounded-lg mb-3">
                                                    <h5 class="font-medium text-gray-900 mb-2">Resources:</h5>
                                                    <div class="space-y-1">
                                                        @foreach($task->resources as $resource)
                                                            <a href="{{ $resource }}" target="_blank" class="block text-blue-600 hover:text-blue-800 text-sm">
                                                                <i class="fas fa-external-link-alt mr-1"></i>{{ $resource }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($task->notes)
                                                <div class="bg-yellow-50 p-3 rounded-lg mb-3">
                                                    <h5 class="font-medium text-gray-900 mb-2">Notes:</h5>
                                                    <p class="text-gray-700 text-sm">{{ $task->notes }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex items-center space-x-2 ml-4">
                                            <button onclick="updateTaskStatus({{ $task->id }})" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition duration-200">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ route('learning-tasks.edit', $task) }}" class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition duration-200">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('learning-tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            @if($tasks->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <i class="fas fa-tasks text-gray-400 text-6xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No learning tasks found</h3>
                        <p class="text-gray-500 mb-6">Start your Laravel learning journey by creating your first task!</p>
                        <a href="{{ route('learning-tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Create Your First Learning Task
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Task Status</h3>
                <form id="statusForm">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="not_started">Not Started</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="reviewed">Reviewed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="actual_hours" class="block text-sm font-medium text-gray-700 mb-1">Actual Hours (optional)</label>
                        <input type="number" id="actual_hours" name="actual_hours" min="1" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeStatusModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- JavaScript for status updates -->
    <script>
        let currentTaskId = null;

        function updateTaskStatus(taskId) {
            currentTaskId = taskId;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
            currentTaskId = null;
        }

        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const status = formData.get('status');
            const actualHours = formData.get('actual_hours');

            fetch(`/learning-tasks/${currentTaskId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    status: status,
                    actual_hours: actualHours
                }),
            })
            .then(response => response.json())
            .then(data => {
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</x-app-layout>
