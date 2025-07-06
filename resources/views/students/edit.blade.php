<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Student') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('students.show', $student) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    View Student
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
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-green-100 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-user-edit mr-3 text-green-600"></i>
                        Edit Student Information
                    </h3>
                    <p class="text-gray-600 mt-1">Update {{ $student->name }}'s information below</p>
                </div>

                <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Profile Picture Section -->
                    <div class="form-section">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-camera text-pink-500"></i>
                            Profile Picture
                        </h4>
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center border-2 border-dashed border-gray-300 hover:border-blue-400 transition-colors duration-200">
                                    @if($student->profile_picture)
                                        <img id="profile-preview" src="{{ asset('storage/' . $student->profile_picture) }}"
                                             alt="{{ $student->name }}"
                                             class="w-24 h-24 rounded-full object-cover">
                                    @else
                                        <img id="profile-preview" class="w-24 h-24 rounded-full object-cover hidden" alt="Profile Preview">
                                        <div class="w-24 h-24 rounded-full bg-gradient-to-r from-blue-400 to-purple-600 flex items-center justify-center text-white text-2xl font-bold" id="default-icon">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file"
                                       name="profile_picture"
                                       id="profile_picture"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <label for="profile_picture" class="cursor-pointer bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition duration-200 text-sm font-medium inline-flex items-center">
                                    <i class="fas fa-upload mr-2"></i>Change Photo
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF (Max 2MB)</p>
                                @error('profile_picture')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user text-blue-500"></i>
                            Basic Information
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="name" name="name" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" :value="old('name', $student->name)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="email" name="email" type="email" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300" :value="old('email', $student->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="phone" name="phone" type="tel" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300" :value="old('phone', $student->phone)" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300" :value="old('date_of_birth', $student->date_of_birth)" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="class" :value="__('Class/Grade Level')" class="text-sm font-semibold text-gray-700" />
                                <select id="class" name="class" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all duration-300" required>
                                    <option value="">Select class/grade</option>
                                    <option value="primary" {{ old('class', $student->class) == 'primary' ? 'selected' : '' }}>Primary School</option>
                                    <option value="middle" {{ old('class', $student->class) == 'middle' ? 'selected' : '' }}>Middle School</option>
                                    <option value="high" {{ old('class', $student->class) == 'high' ? 'selected' : '' }}>High School</option>
                                    <option value="college" {{ old('class', $student->class) == 'college' ? 'selected' : '' }}>College/University</option>
                                    <option value="graduate" {{ old('class', $student->class) == 'graduate' ? 'selected' : '' }}>Graduate Studies</option>
                                    <option value="professional" {{ old('class', $student->class) == 'professional' ? 'selected' : '' }}>Professional Development</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('class')" />
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="form-section">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            Address Information
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="street_address" :value="__('Street Address')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="street_address" name="street_address" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300" :value="old('street_address', $student->street_address)" placeholder="Enter street address" />
                                <x-input-error class="mt-2" :messages="$errors->get('street_address')" />
                            </div>

                            <div>
                                <x-input-label for="city" :value="__('City')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="city" name="city" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300" :value="old('city', $student->city)" placeholder="Enter city" />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            <div>
                                <x-input-label for="state" :value="__('State/Province')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="state" name="state" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" :value="old('state', $student->state)" placeholder="Enter state/province" />
                                <x-input-error class="mt-2" :messages="$errors->get('state')" />
                            </div>

                            <div>
                                <x-input-label for="country" :value="__('Country')" class="text-sm font-semibold text-gray-700" />
                                <select id="country" name="country" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300">
                                    <option value="">Select country</option>
                                    <option value="Pakistan" {{ old('country', $student->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    <option value="USA" {{ old('country', $student->country) == 'USA' ? 'selected' : '' }}>United States</option>
                                    <option value="UK" {{ old('country', $student->country) == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="Canada" {{ old('country', $student->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    <option value="Australia" {{ old('country', $student->country) == 'Australia' ? 'selected' : '' }}>Australia</option>
                                    <option value="Germany" {{ old('country', $student->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
                                    <option value="France" {{ old('country', $student->country) == 'France' ? 'selected' : '' }}>France</option>
                                    <option value="India" {{ old('country', $student->country) == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="China" {{ old('country', $student->country) == 'China' ? 'selected' : '' }}>China</option>
                                    <option value="Japan" {{ old('country', $student->country) == 'Japan' ? 'selected' : '' }}>Japan</option>
                                    <option value="other" {{ old('country', $student->country) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('country')" />
                            </div>

                            <div>
                                <x-input-label for="postal_code" :value="__('Postal Code')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300" :value="old('postal_code', $student->postal_code)" placeholder="Enter postal code" />
                                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center gap-4 pt-6">
                        <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white font-bold py-3 px-8 rounded-xl hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-4 focus:ring-green-500/30 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                <span>Update Student</span>
                            </div>
                        </button>

                        <a href="{{ route('students.show', $student) }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300">
                            Cancel
                        </a>
                    </div>
                </form>
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

    <script>
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
                    if (defaultIcon) {
                        defaultIcon.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                if (defaultIcon) {
                    defaultIcon.classList.remove('hidden');
                }
            }
        }
    </script>
</x-app-layout>
