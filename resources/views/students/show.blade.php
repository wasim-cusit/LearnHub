<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student Details') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('students.edit', $student) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Student
                </a>
                <a href="{{ route('students.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Students
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Profile Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-xl p-8 text-white mb-8">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center border-4 border-white/30">
                            @if($student->profile_picture)
                                <img src="{{ asset('storage/' . $student->profile_picture) }}"
                                     alt="{{ $student->name }}"
                                     class="w-28 h-28 rounded-full object-cover">
                            @else
                                <div class="w-28 h-28 rounded-full bg-white/20 flex items-center justify-center text-white text-4xl font-bold">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 rounded-full border-4 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold mb-2">{{ $student->name }}</h1>
                        <p class="text-blue-100 mb-1">
                            <i class="fas fa-envelope mr-2"></i>{{ $student->email }}
                        </p>
                        <div class="flex items-center space-x-4 text-sm">
                            <span class="bg-white/20 px-3 py-1 rounded-full">
                                <i class="fas fa-user-tag mr-1"></i>Student
                            </span>
                            @if($student->class)
                                <span class="bg-white/20 px-3 py-1 rounded-full">
                                    <i class="fas fa-graduation-cap mr-1"></i>{{ ucfirst($student->class) }}
                                </span>
                            @endif
                            @if($student->created_by)
                                <span class="bg-green-500/20 px-3 py-1 rounded-full">
                                    <i class="fas fa-user-plus mr-1"></i>Created by you
                                </span>
                            @else
                                <span class="bg-blue-500/20 px-3 py-1 rounded-full">
                                    <i class="fas fa-user mr-1"></i>Self-registered
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Information Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Basic Information -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user mr-3 text-blue-600"></i>
                            Basic Information
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Full Name</span>
                            <span class="text-sm text-gray-900">{{ $student->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Email Address</span>
                            <span class="text-sm text-gray-900">{{ $student->email }}</span>
                        </div>
                        @if($student->phone)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Phone Number</span>
                                <span class="text-sm text-gray-900">{{ $student->phone }}</span>
                            </div>
                        @endif
                        @if($student->date_of_birth)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Date of Birth</span>
                                <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if($student->class)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Class/Grade</span>
                                <span class="text-sm text-gray-900">{{ ucfirst($student->class) }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-red-600"></i>
                            Address Information
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($student->street_address)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Street Address</span>
                                <span class="text-sm text-gray-900">{{ $student->street_address }}</span>
                            </div>
                        @endif
                        @if($student->city)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">City</span>
                                <span class="text-sm text-gray-900">{{ $student->city }}</span>
                            </div>
                        @endif
                        @if($student->state)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">State/Province</span>
                                <span class="text-sm text-gray-900">{{ $student->state }}</span>
                            </div>
                        @endif
                        @if($student->country)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Country</span>
                                <span class="text-sm text-gray-900">{{ $student->country }}</span>
                            </div>
                        @endif
                        @if($student->postal_code)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Postal Code</span>
                                <span class="text-sm text-gray-900">{{ $student->postal_code }}</span>
                            </div>
                        @endif
                        @if(!$student->street_address && !$student->city && !$student->state && !$student->country && !$student->postal_code)
                            <div class="text-center py-4">
                                <i class="fas fa-map-marker-alt text-gray-300 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-500">No address information provided</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-green-600"></i>
                        Account Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-calendar text-blue-600 text-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900">Joined Date</h4>
                            <p class="text-sm text-gray-500">{{ $student->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-clock text-green-600 text-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900">Account Age</h4>
                            <p class="text-sm text-gray-500">{{ $student->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user-check text-purple-600 text-xl"></i>
                            </div>
                            <h4 class="font-medium text-gray-900">Account Type</h4>
                            <p class="text-sm text-gray-500">
                                @if($student->created_by)
                                    Teacher Created
                                @else
                                    Self Registered
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
