<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:teacher,student'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'class' => ['nullable', 'string', 'max:50'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'class' => $request->class,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                $profilePicture = $request->file('profile_picture');
                $filename = time() . '_' . $profilePicture->getClientOriginalName();

                // Ensure the directory exists
                $directory = storage_path('app/public/profile-pictures');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Store the file
                $path = $profilePicture->storeAs('public/profile-pictures', $filename);

                if ($path) {
                    $userData['profile_picture'] = 'profile-pictures/' . $filename;
                } else {
                    // Log error if upload fails
                    Log::error('Profile picture upload failed for user: ' . $request->email);
                }
            } catch (\Exception $e) {
                // Log any exceptions during upload
                Log::error('Profile picture upload exception: ' . $e->getMessage());
            }
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')->with('success', 'Welcome to LearnHub! Your teacher dashboard is ready. You can now create student accounts for your class.');
        } else {
            return redirect()->route('student.dashboard')->with('success', 'Welcome to LearnHub! Your student dashboard is ready.');
        }
    }
}
