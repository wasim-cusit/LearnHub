<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                // Delete old profile picture if exists
                if ($user->profile_picture) {
                    $oldPath = storage_path('app/public/' . $user->profile_picture);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

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
                    $validatedData['profile_picture'] = 'profile-pictures/' . $filename;
                } else {
                    // Log error if upload fails
                    \Illuminate\Support\Facades\Log::error('Profile picture upload failed for user: ' . $user->email);
                }
            } catch (\Exception $e) {
                // Log any exceptions during upload
                \Illuminate\Support\Facades\Log::error('Profile picture upload exception: ' . $e->getMessage());
            }
        }

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
