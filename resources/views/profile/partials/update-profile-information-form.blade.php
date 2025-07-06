<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('patch')

        <!-- Profile Picture Section -->
        <div class="form-section">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-camera text-pink-500"></i>
                Profile Picture
            </h4>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center border-2 border-dashed border-gray-300 hover:border-blue-400 transition-colors duration-200">
                                                @if($user->profile_picture)
                            <img id="profile-preview" src="{{ asset('storage/' . $user->profile_picture) }}"
                                 alt="{{ $user->name }}"
                                 class="w-24 h-24 rounded-full object-cover">
                        @else
                            <img id="profile-preview" class="w-24 h-24 rounded-full object-cover hidden" alt="Profile Preview">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-r from-blue-400 to-purple-600 flex items-center justify-center text-white text-2xl font-bold" id="default-icon">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 rounded-full border-4 border-white flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
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
                    <x-text-input id="name" name="name" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="email" name="email" type="email" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3">
                            <p class="text-sm text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="phone" name="phone" type="tel" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300" :value="old('phone', $user->phone)" autocomplete="tel" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <div>
                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300" :value="old('date_of_birth', $user->date_of_birth)" />
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                </div>

                <div>
                    <x-input-label for="class" :value="__('Class/Grade Level')" class="text-sm font-semibold text-gray-700" />
                    <select id="class" name="class" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all duration-300">
                        <option value="">Select your class/grade</option>
                        <option value="primary" {{ old('class', $user->class) == 'primary' ? 'selected' : '' }}>Primary School</option>
                        <option value="middle" {{ old('class', $user->class) == 'middle' ? 'selected' : '' }}>Middle School</option>
                        <option value="high" {{ old('class', $user->class) == 'high' ? 'selected' : '' }}>High School</option>
                        <option value="college" {{ old('class', $user->class) == 'college' ? 'selected' : '' }}>College/University</option>
                        <option value="graduate" {{ old('class', $user->class) == 'graduate' ? 'selected' : '' }}>Graduate Studies</option>
                        <option value="professional" {{ old('class', $user->class) == 'professional' ? 'selected' : '' }}>Professional Development</option>
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
                    <x-text-input id="street_address" name="street_address" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300" :value="old('street_address', $user->street_address)" placeholder="Enter your street address" />
                    <x-input-error class="mt-2" :messages="$errors->get('street_address')" />
                </div>

                <div>
                    <x-input-label for="city" :value="__('City')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="city" name="city" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300" :value="old('city', $user->city)" placeholder="Enter your city" />
                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                </div>

                <div>
                    <x-input-label for="state" :value="__('State/Province')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="state" name="state" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" :value="old('state', $user->state)" placeholder="Enter your state/province" />
                    <x-input-error class="mt-2" :messages="$errors->get('state')" />
                </div>

                <div>
                    <x-input-label for="country" :value="__('Country')" class="text-sm font-semibold text-gray-700" />
                    <select id="country" name="country" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300">
                        <option value="">Select your country</option>
                        <option value="Pakistan" {{ old('country', $user->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                        <option value="USA" {{ old('country', $user->country) == 'USA' ? 'selected' : '' }}>United States</option>
                        <option value="UK" {{ old('country', $user->country) == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="Canada" {{ old('country', $user->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                        <option value="Australia" {{ old('country', $user->country) == 'Australia' ? 'selected' : '' }}>Australia</option>
                        <option value="Germany" {{ old('country', $user->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
                        <option value="France" {{ old('country', $user->country) == 'France' ? 'selected' : '' }}>France</option>
                        <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>India</option>
                        <option value="China" {{ old('country', $user->country) == 'China' ? 'selected' : '' }}>China</option>
                        <option value="Japan" {{ old('country', $user->country) == 'Japan' ? 'selected' : '' }}>Japan</option>
                        <option value="other" {{ old('country', $user->country) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('country')" />
                </div>

                <div>
                    <x-input-label for="postal_code" :value="__('Postal Code')" class="text-sm font-semibold text-gray-700" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-2 block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300" :value="old('postal_code', $user->postal_code)" placeholder="Enter your postal code" />
                    <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4 pt-6">
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-3 px-8 rounded-xl hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <div class="flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    <span>Save Changes</span>
                </div>
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 bg-green-50 px-4 py-2 rounded-lg flex items-center"
                >
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ __('Profile updated successfully!') }}
                </p>
            @endif
        </div>
    </form>

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
</section>
