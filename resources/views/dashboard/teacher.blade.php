<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <i class="fas fa-chalkboard-teacher mr-2 text-purple-600"></i>Teacher Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Create Task
                </a>
                <a href="{{ route('students.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-users mr-2"></i>View Students
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
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-users text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">My Students</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_students'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tasks text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Tasks Created</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_tasks_created'] }}</p>
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
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Tasks -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <i class="fas fa-list mr-2 text-purple-600"></i>Recent Tasks
                                </h3>
                                <a href="{{ route('tasks.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">View All</a>
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
                                                        <span class="text-xs text-gray-500">
                                                            <i class="fas fa-calendar mr-1"></i>
                                                            {{ $task->created_at->format('M d, Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-tasks text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 mb-4">No tasks created yet.</p>
                                    <a href="{{ route('tasks.create') }}" class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                        Create Your First Task
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
                                <i class="fas fa-bolt mr-2 text-purple-600"></i>Quick Actions
                            </h3>
                            <div class="space-y-3">
                                <a href="{{ route('tasks.create') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                                    <i class="fas fa-plus text-purple-600 mr-3"></i>
                                    <span class="text-purple-800 font-medium">Create New Task</span>
                                </a>
                                <a href="{{ route('students.index') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                                    <i class="fas fa-users text-blue-600 mr-3"></i>
                                    <span class="text-blue-800 font-medium">Manage Students</span>
                                </a>
                                <a href="{{ route('tasks.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                                    <i class="fas fa-list text-green-600 mr-3"></i>
                                    <span class="text-green-800 font-medium">View All Tasks</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-200">
                                    <i class="fas fa-user text-yellow-600 mr-3"></i>
                                    <span class="text-yellow-800 font-medium">Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Students -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-graduation-cap mr-2 text-purple-600"></i>Recent Students
                            </h3>
                            @if($students->count() > 0)
                                <div class="space-y-3">
                                    @foreach($students as $student)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                                @if($student->profile_picture)
                                                    <img src="{{ asset('storage/' . $student->profile_picture) }}"
                                                         alt="{{ $student->name }}"
                                                         class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <span class="text-white text-sm font-medium">{{ strtoupper(substr($student->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $student->name }}</h4>
                                                <p class="text-xs text-gray-500">{{ $student->email }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('students.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">View All Students</a>
                                </div>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-users text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="text-gray-500 mb-3">No students created yet.</p>
                                    <a href="{{ route('students.create') }}" class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 text-sm">
                                        Create Student Account
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
