<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-indigo-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-green-400/10 to-blue-400/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-2xl w-full space-y-8 relative z-10">
            <!-- Header with custom logo -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
                        <i class="fas fa-graduation-cap text-white text-3xl"></i>
                    </div>
                </div>
                <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                    Join LearnHub
                </h2>
                <p class="text-gray-600 text-lg">Begin your learning adventure today</p>
                <div class="flex items-center justify-center mt-4 space-x-2">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-600 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">Join 10,000+ learners</span>
                </div>
            </div>

            <!-- Enhanced Registration Form -->
            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Profile Picture Upload -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-pink-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-camera text-white text-sm"></i>
                            </div>
                            Profile Picture
                        </label>
                        <div class="flex items-center space-x-4">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center border-2 border-dashed border-gray-300 hover:border-blue-400 transition-colors duration-200">
                                <img id="profile-preview" class="w-20 h-20 rounded-full object-cover hidden" alt="Profile Preview">
                                <i class="fas fa-user text-gray-400 text-2xl" id="default-icon"></i>
                            </div>
                            <div class="flex-1">
                                <input type="file"
                                       name="profile_picture"
                                       id="profile_picture"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <label for="profile_picture" class="cursor-pointer bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition duration-200 text-sm font-medium">
                                    <i class="fas fa-upload mr-2"></i>Choose Photo
                                </label>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max 2MB)</p>
                            </div>
                        </div>
                        @error('profile_picture')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Name Field -->
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            Full Name
                        </label>
                        <div class="relative">
                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 @error('name') border-red-500 focus:ring-red-500/20 @enderror"
                                   placeholder="Enter your full name">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-white text-sm"></i>
                            </div>
                            Email Address
                        </label>
                        <div class="relative">
                            <input id="email"
                                   name="email"
                                   type="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="username"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 @error('email') border-red-500 focus:ring-red-500/20 @enderror"
                                   placeholder="Enter your email address">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div class="group">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-teal-400 to-teal-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-white text-sm"></i>
                            </div>
                            Phone Number
                        </label>
                        <div class="relative">
                            <input id="phone"
                                   name="phone"
                                   type="tel"
                                   value="{{ old('phone') }}"
                                   autocomplete="tel"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 @error('phone') border-red-500 focus:ring-red-500/20 @enderror"
                                   placeholder="Enter your phone number">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                        </div>
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Date of Birth Field -->
                    <div class="group">
                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-white text-sm"></i>
                            </div>
                            Date of Birth
                        </label>
                        <div class="relative">
                            <input id="date_of_birth"
                                   name="date_of_birth"
                                   type="date"
                                   value="{{ old('date_of_birth') }}"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 @error('date_of_birth') border-red-500 focus:ring-red-500/20 @enderror">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                        </div>
                        @error('date_of_birth')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Class/Grade Field -->
                    <div class="group">
                        <label for="class" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-graduation-cap text-white text-sm"></i>
                            </div>
                            Class/Grade Level
                        </label>
                        <div class="relative">
                            <select id="class"
                                    name="class"
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all duration-300 @error('class') border-red-500 focus:ring-red-500/20 @enderror">
                                <option value="">Select your class/grade</option>
                                <option value="primary" {{ old('class') == 'primary' ? 'selected' : '' }}>Primary School</option>
                                <option value="middle" {{ old('class') == 'middle' ? 'selected' : '' }}>Middle School</option>
                                <option value="high" {{ old('class') == 'high' ? 'selected' : '' }}>High School</option>
                                <option value="college" {{ old('class') == 'college' ? 'selected' : '' }}>College/University</option>
                                <option value="graduate" {{ old('class') == 'graduate' ? 'selected' : '' }}>Graduate Studies</option>
                                <option value="professional" {{ old('class') == 'professional' ? 'selected' : '' }}>Professional Development</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('class')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Address Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Street Address -->
                        <div class="group">
                            <label for="street_address" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-red-400 to-red-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                </div>
                                Street Address
                            </label>
                            <div class="relative">
                                <input id="street_address"
                                       name="street_address"
                                       type="text"
                                       value="{{ old('street_address') }}"
                                       class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 @error('street_address') border-red-500 focus:ring-red-500/20 @enderror"
                                       placeholder="Enter street address">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                            </div>
                            @error('street_address')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="group">
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-city text-white text-sm"></i>
                                </div>
                                City
                            </label>
                            <div class="relative">
                                <input id="city"
                                       name="city"
                                       type="text"
                                       value="{{ old('city') }}"
                                       class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 @error('city') border-red-500 focus:ring-red-500/20 @enderror"
                                       placeholder="Enter city">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-city text-gray-400"></i>
                                </div>
                            </div>
                            @error('city')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- State and Country -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- State/Province -->
                        <div class="group">
                            <label for="state" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-map text-white text-sm"></i>
                                </div>
                                State/Province
                            </label>
                            <div class="relative">
                                <input id="state"
                                       name="state"
                                       type="text"
                                       value="{{ old('state') }}"
                                       class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 @error('state') border-red-500 focus:ring-red-500/20 @enderror"
                                       placeholder="Enter state/province">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map text-gray-400"></i>
                                </div>
                            </div>
                            @error('state')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="group">
                            <label for="country" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-globe text-white text-sm"></i>
                                </div>
                                Country
                            </label>
                            <div class="relative">
                                <select id="country"
                                        name="country"
                                        class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 @error('country') border-red-500 focus:ring-red-500/20 @enderror">
                                    <option value="">Select your country</option>
                                    <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States</option>
                                    <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                    <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                    <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                    <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                    <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                    <option value="other" {{ old('country') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('country')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Postal Code -->
                    <div class="group">
                        <label for="postal_code" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-mail-bulk text-white text-sm"></i>
                            </div>
                            Postal Code
                        </label>
                        <div class="relative">
                            <input id="postal_code"
                                   name="postal_code"
                                   type="text"
                                   value="{{ old('postal_code') }}"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 @error('postal_code') border-red-500 focus:ring-red-500/20 @enderror"
                                   placeholder="Enter postal code">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-mail-bulk text-gray-400"></i>
                            </div>
                        </div>
                        @error('postal_code')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Role Selection -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-white text-sm"></i>
                            </div>
                            Choose Your Role
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative group">
                                <input type="radio" id="role_student" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }} class="sr-only" required>
                                <label for="role_student" class="role-option cursor-pointer block p-6 border-2 border-gray-200 rounded-2xl hover:border-green-300 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                                        </div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2">Student</h3>
                                        <p class="text-sm text-gray-600 mb-3">I want to learn and grow</p>
                                        <div class="flex items-center justify-center space-x-1">
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="relative group">
                                <input type="radio" id="role_teacher" name="role" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }} class="sr-only" required>
                                <label for="role_teacher" class="role-option cursor-pointer block p-6 border-2 border-gray-200 rounded-2xl hover:border-purple-300 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                            <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                                        </div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2">Teacher</h3>
                                        <p class="text-sm text-gray-600 mb-3">I want to inspire others</p>
                                        <div class="flex items-center justify-center space-x-1">
                                            <i class="fas fa-crown text-purple-400 text-xs"></i>
                                            <i class="fas fa-crown text-purple-400 text-xs"></i>
                                            <i class="fas fa-crown text-purple-400 text-xs"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-lock text-white text-sm"></i>
                            </div>
                            Password
                        </label>
                        <div class="relative">
                            <input id="password"
                                   name="password"
                                   type="password"
                                   required
                                   autocomplete="new-password"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 @error('password') border-red-500 focus:ring-red-500/20 @enderror"
                                   placeholder="Create a strong password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="group">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-red-400 to-red-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-shield-alt text-white text-sm"></i>
                            </div>
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input id="password_confirmation"
                                   name="password_confirmation"
                                   type="password"
                                   required
                                   autocomplete="new-password"
                                   class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300"
                                   placeholder="Confirm your password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-shield-alt text-gray-400"></i>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Submit Button -->
                    <div class="pt-6">
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-rocket mr-3 text-lg"></i>
                                <span class="text-lg">Launch Your Journey</span>
                            </div>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center pt-4">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition duration-200 underline decoration-2 underline-offset-2">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Trust Indicators -->
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center space-x-6 text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                        <span class="text-sm">Secure & Private</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2 text-blue-500"></i>
                        <span class="text-sm">Free Forever</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-headset mr-2 text-purple-500"></i>
                        <span class="text-sm">24/7 Support</span>
                    </div>
                </div>

                <!-- Social Proof -->
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                    <div class="flex items-center justify-center space-x-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">10K+</div>
                            <div class="text-xs text-gray-600">Active Learners</div>
                        </div>
                        <div class="w-px h-8 bg-gray-300"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50+</div>
                            <div class="text-xs text-gray-600">Expert Teachers</div>
                        </div>
                        <div class="w-px h-8 bg-gray-300"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">100+</div>
                            <div class="text-xs text-gray-600">Learning Paths</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .role-option input[type="radio"]:checked + label {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }

        .role-option input[type="radio"]:checked + label .w-16 {
            transform: scale(1.1);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.25);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }
    </style>

    <script>
        // Enhanced role selection with animations
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.role-option').forEach(option => {
                    option.classList.remove('ring-4', 'ring-blue-500/30');
                });
                if (this.checked) {
                    this.nextElementSibling.classList.add('ring-4', 'ring-blue-500/30');
                }
            });
        });

        // Profile picture preview functionality
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('profile-preview');
            const defaultIcon = document.getElementById('default-icon');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    defaultIcon.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                defaultIcon.classList.remove('hidden');
            }
        }

        // Add floating animation to background elements
        document.addEventListener('DOMContentLoaded', function() {
            const floatingElements = document.querySelectorAll('.absolute');
            floatingElements.forEach((element, index) => {
                element.style.animation = `float ${3 + index}s ease-in-out infinite`;
            });
        });

        // Add keyframe animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</x-guest-layout>
