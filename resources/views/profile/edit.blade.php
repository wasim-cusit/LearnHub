<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile Settings') }}
            </h2>
            <div class="flex items-center space-x-2">
                <i class="fas fa-user-cog text-blue-600"></i>
                <span class="text-sm text-gray-600">Manage your account</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center border-4 border-white/30">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                     alt="{{ $user->name }}"
                                     class="w-20 h-20 rounded-full object-cover">
                            @else
                                <i class="fas fa-user text-white text-3xl"></i>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 rounded-full border-4 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>
                        <p class="text-blue-100 mb-1">
                            <i class="fas fa-envelope mr-2"></i>{{ $user->email }}
                        </p>
                        <div class="flex items-center space-x-4 text-sm">
                            <span class="bg-white/20 px-3 py-1 rounded-full">
                                <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($user->role) }}
                            </span>
                            @if($user->class)
                                <span class="bg-white/20 px-3 py-1 rounded-full">
                                    <i class="fas fa-graduation-cap mr-1"></i>{{ ucfirst($user->class) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information Form -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-user-edit mr-3 text-blue-600"></i>
                        Profile Information
                    </h3>
                    <p class="text-gray-600 mt-1">Update your personal information and contact details</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Form -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-lock mr-3 text-green-600"></i>
                        Security Settings
                    </h3>
                    <p class="text-gray-600 mt-1">Update your password and security preferences</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account Management -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-cog mr-3 text-red-600"></i>
                        Account Management
                    </h3>
                    <p class="text-gray-600 mt-1">Manage your account settings and data</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-section h4 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .form-section h4 i {
            margin-right: 0.5rem;
            width: 1.5rem;
        }
    </style>
</x-app-layout>
