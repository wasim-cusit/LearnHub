<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <i class="fas fa-graduation-cap mr-2 text-green-600"></i>Student Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Ready to learn?</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('learning-tasks.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-book mr-2"></i>Learning Path
                </a>
                <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-tasks mr-2"></i>View Tasks
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tasks text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-check text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Completed</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-star text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Learning Progress</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['learning_progress'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Overview -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-chart-line mr-2 text-green-600"></i>Your Progress
                    </h3>
                    @if($stats['total_tasks'] > 0)
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Task Completion Rate</span>
                                    <span>{{ round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-500" style="width: {{ ($stats['completed_tasks'] / $stats['total_tasks']) * 100 }}%"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_tasks'] }}</p>
                                <p class="text-sm text-gray-500">of {{ $stats['total_tasks'] }} tasks completed</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No tasks to track yet. Start your learning journey!</p>
                    @endif
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Tasks -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <i class="fas fa-list mr-2 text-green-600"></i>Recent Tasks
                                </h3>
                                <a href="{{ route('tasks.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">View All</a>
                            </div>

                            @if($recentTasks->count() > 0)
                                <div class="space-y-4">
                                    @foreach($recentTasks as $task)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 rounded-full {{ $task->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
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
                                                                Due: {{ $task->due_date->format('M d, Y') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                @if($task->status !== 'completed')
                                                    <button onclick="toggleTaskStatus({{ $task->id }})" class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-tasks text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 mb-4">No tasks assigned yet.</p>
                                    <a href="{{ route('learning-tasks.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                        Start Learning
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-bolt mr-2 text-green-600"></i>Quick Actions
                            </h3>
                            <div class="space-y-3">
                                <a href="{{ route('learning-tasks.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                                    <i class="fas fa-book text-green-600 mr-3"></i>
                                    <span class="text-green-800 font-medium">Learning Path</span>
                                </a>
                                <a href="{{ route('learning-tasks.dashboard') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                                    <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                                    <span class="text-blue-800 font-medium">Progress Tracker</span>
                                </a>
                                <a href="{{ route('tasks.index') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                                    <i class="fas fa-list text-purple-600 mr-3"></i>
                                    <span class="text-purple-800 font-medium">View All Tasks</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-200">
                                    <i class="fas fa-user text-yellow-600 mr-3"></i>
                                    <span class="text-yellow-800 font-medium">Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Learning Progress -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-graduation-cap mr-2 text-green-600"></i>Learning Progress
                            </h3>
                            @if($learningTasks->count() > 0)
                                <div class="space-y-3">
                                    @foreach($learningTasks as $task)
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <h4 class="font-medium text-gray-900 text-sm">{{ $task->title }}</h4>
                                            <div class="flex items-center space-x-2 mt-1">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('learning-tasks.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">View All Learning Tasks</a>
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No learning tasks yet.</p>
                                <div class="text-center">
                                    <a href="{{ route('learning-tasks.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Start Learning</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Motivational Quote -->
                    <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-xl p-6 text-white">
                        <div class="text-center">
                            <i class="fas fa-quote-left text-2xl mb-2 opacity-75"></i>
                            <p class="text-sm font-medium mb-2">"Education is the most powerful weapon which you can use to change the world."</p>
                            <p class="text-xs opacity-75">- Nelson Mandela</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-app-layout>
