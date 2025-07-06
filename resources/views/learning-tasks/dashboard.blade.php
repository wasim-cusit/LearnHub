<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Learning Progress Dashboard') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('learning-tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-list mr-2"></i>View All Tasks
                </a>
                <a href="{{ route('learning-tasks.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Task
                </a>
            </div>
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

            <!-- Overall Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
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
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">In Progress</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['in_progress_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-hourglass text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Not Started</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['not_started_tasks'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-star text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Milestones</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['milestones'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Progress -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Overall Progress</h3>
                    @if($stats['total_tasks'] > 0)
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Completion Rate</span>
                                    <span>{{ round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-500 h-3 rounded-full transition-all duration-500" style="width: {{ ($stats['completed_tasks'] / $stats['total_tasks']) * 100 }}%"></div>
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

            <!-- Phase Progress -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Phase Progress</h3>
                        <div class="space-y-4">
                            @foreach($phaseProgress as $phase => $progress)
                                @if($progress['total'] > 0)
                                    <div>
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $phase)) }}</span>
                                            <span>{{ $progress['completed'] }}/{{ $progress['total'] }} ({{ $progress['percentage'] }}%)</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ $progress['percentage'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Tasks</h3>
                            <a href="{{ route('learning-tasks.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                        </div>

                        @if($recentTasks->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentTasks as $task)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                {{ $task->title }}
                                            </h4>
                                            <div class="flex items-center space-x-2 mt-1">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                    @elseif($task->status === 'reviewed') bg-purple-100 text-purple-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                                <span class="text-xs text-gray-500">{{ $task->getPhaseDisplayName() }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('learning-tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No recent tasks</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Upcoming Tasks -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Tasks</h3>
                    @if($upcomingTasks->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($upcomingTasks as $task)
                                <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                                    <h4 class="font-medium text-gray-900">{{ $task->title }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-calendar mr-1"></i>
                                        Due: {{ $task->due_date->format('M d, Y') }}
                                    </p>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($task->priority === 'critical') bg-red-100 text-red-800
                                            @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                        @if($task->is_milestone)
                                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                                                <i class="fas fa-star mr-1"></i>Milestone
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No upcoming tasks</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
