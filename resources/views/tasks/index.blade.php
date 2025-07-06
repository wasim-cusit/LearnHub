<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Tasks') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Dashboard
                </a>
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>New Task
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
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status_filter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div>
                            <label for="priority_filter" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select id="priority_filter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Priorities</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                            <select id="sort_by" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="created_at">Created Date</option>
                                <option value="due_date">Due Date</option>
                                <option value="priority">Priority</option>
                                <option value="title">Title</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button onclick="clearFilters()" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($tasks->count() > 0)
                        <div class="space-y-4">
                            @foreach($tasks as $task)
                                <div class="task-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200"
                                     data-status="{{ $task->status }}"
                                     data-priority="{{ $task->priority }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <button onclick="toggleTaskStatus({{ $task->id }})" class="task-toggle-btn" data-task-id="{{ $task->id }}">
                                                <div class="w-6 h-6 border-2 rounded {{ $task->status === 'completed' ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center">
                                                    @if($task->status === 'completed')
                                                        <i class="fas fa-check text-white text-sm"></i>
                                                    @endif
                                                </div>
                                            </button>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <h3 class="text-lg font-medium text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                        {{ $task->title }}
                                                    </h3>
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($task->priority === 'high') bg-red-100 text-red-800
                                                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                        @else bg-green-100 text-green-800
                                                        @endif">
                                                        {{ ucfirst($task->priority) }}
                                                    </span>
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($task->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                    </span>
                                                </div>
                                                @if($task->description)
                                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($task->description, 100) }}</p>
                                                @endif
                                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                                    <span>
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        Created: {{ $task->created_at->format('M d, Y') }}
                                                    </span>
                                                    @if($task->due_date)
                                                        <span class="{{ $task->due_date->isPast() && $task->status !== 'completed' ? 'text-red-600 font-medium' : '' }}">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            Due: {{ $task->due_date->format('M d, Y') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition duration-200">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
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
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-tasks text-gray-400 text-6xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No tasks found</h3>
                            <p class="text-gray-500 mb-6">Get started by creating your first task!</p>
                            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                                <i class="fas fa-plus mr-2"></i>Create Your First Task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- JavaScript for filtering and task toggle functionality -->
    <script>
        function toggleTaskStatus(taskId) {
            fetch(`/tasks/${taskId}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function clearFilters() {
            document.getElementById('status_filter').value = '';
            document.getElementById('priority_filter').value = '';
            document.getElementById('sort_by').value = 'created_at';
            filterTasks();
        }

        function filterTasks() {
            const statusFilter = document.getElementById('status_filter').value;
            const priorityFilter = document.getElementById('priority_filter').value;
            const taskItems = document.querySelectorAll('.task-item');

            taskItems.forEach(item => {
                const status = item.dataset.status;
                const priority = item.dataset.priority;

                const statusMatch = !statusFilter || status === statusFilter;
                const priorityMatch = !priorityFilter || priority === priorityFilter;

                if (statusMatch && priorityMatch) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Add event listeners for filters
        document.getElementById('status_filter').addEventListener('change', filterTasks);
        document.getElementById('priority_filter').addEventListener('change', filterTasks);
    </script>
</x-app-layout>
