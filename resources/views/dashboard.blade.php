<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>New Task
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tasks text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Completed</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">High Priority</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['high_priority_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Tasks -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Recent Tasks</h3>
                                <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                            </div>

                            @if($recentTasks->count() > 0)
                                <div class="space-y-3">
                                    @foreach($recentTasks as $task)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                            <div class="flex items-center space-x-3">
                                                <button onclick="toggleTaskStatus({{ $task->id }})" class="task-toggle-btn" data-task-id="{{ $task->id }}">
                                                    <div class="w-5 h-5 border-2 rounded {{ $task->status === 'completed' ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center">
                                                        @if($task->status === 'completed')
                                                            <i class="fas fa-check text-white text-xs"></i>
                                                        @endif
                                                    </div>
                                                </button>
                                                <div>
                                                    <h4 class="font-medium text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                        {{ $task->title }}
                                                    </h4>
                                                    <div class="flex items-center space-x-2 mt-1">
                                                        <span class="px-2 py-1 text-xs rounded-full
                                                            @if($task->priority === 'high') bg-red-100 text-red-800
                                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                            @else bg-green-100 text-green-800
                                                            @endif">
                                                            {{ ucfirst($task->priority) }}
                                                        </span>
                                                        @if($task->due_date)
                                                            <span class="text-xs text-gray-500">
                                                                <i class="fas fa-calendar mr-1"></i>
                                                                {{ $task->due_date->format('M d') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-tasks text-gray-400 text-4xl mb-4"></i>
                                    <p class="text-gray-500">No tasks yet. Create your first task!</p>
                                    <a href="{{ route('tasks.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                        Create Task
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('learning-tasks.index') }}" class="flex items-center p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition duration-200">
                                    <i class="fas fa-graduation-cap text-indigo-600 mr-3"></i>
                                    <span class="text-indigo-800 font-medium">Laravel Learning Roadmap</span>
                                </a>
                                <a href="{{ route('tasks.create') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                                    <i class="fas fa-plus text-blue-600 mr-3"></i>
                                    <span class="text-blue-800 font-medium">Add New Task</span>
                                </a>
                                <a href="{{ route('tasks.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                                    <i class="fas fa-list text-green-600 mr-3"></i>
                                    <span class="text-green-800 font-medium">View All Tasks</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                                    <i class="fas fa-user text-purple-600 mr-3"></i>
                                    <span class="text-purple-800 font-medium">Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Tasks -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Tasks</h3>
                            @if($upcomingTasks->count() > 0)
                                <div class="space-y-3">
                                    @foreach($upcomingTasks as $task)
                                        <div class="p-3 bg-orange-50 rounded-lg">
                                            <h4 class="font-medium text-gray-900">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <i class="fas fa-calendar mr-1"></i>
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                            </p>
                                            <span class="inline-block mt-2 px-2 py-1 text-xs rounded-full
                                                @if($task->priority === 'high') bg-red-100 text-red-800
                                                @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No upcoming tasks</p>
                            @endif
                        </div>
                    </div>

                    <!-- Progress Overview -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Overview</h3>
                            @if($stats['total_tasks'] > 0)
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Completion Rate</span>
                                            <span>{{ round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($stats['completed_tasks'] / $stats['total_tasks']) * 100 }}%"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_tasks'] }}</p>
                                        <p class="text-sm text-gray-500">of {{ $stats['total_tasks'] }} tasks completed</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No tasks to track</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- JavaScript for task toggle functionality -->
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
                // Reload the page to update the UI
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-app-layout>
