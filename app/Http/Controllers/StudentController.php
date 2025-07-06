<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    /**
     * Display a listing of students for the teacher.
     */
    public function index()
    {
        $students = User::where('role', 'student')
                       ->where('created_by', Auth::id()) // Only show students created by this teacher
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'class' => ['required', 'string', 'max:50'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Generate a random password for the student
        $password = 'student' . rand(1000, 9999);

        $studentData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'student',
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'class' => $request->class,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'created_by' => Auth::id(), // Track which teacher created this student
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
                    $studentData['profile_picture'] = 'profile-pictures/' . $filename;
                } else {
                    // Log error if upload fails
                    \Illuminate\Support\Facades\Log::error('Student profile picture upload failed during creation for: ' . $request->email);
                }
            } catch (\Exception $e) {
                // Log any exceptions during upload
                \Illuminate\Support\Facades\Log::error('Student profile picture upload exception during creation: ' . $e->getMessage());
            }
        }

        $student = User::create($studentData);

        return redirect()->route('students.index')
                        ->with('success', "Student account created successfully! Email: {$student->email}, Password: {$password}");
    }

    /**
     * Display the specified student.
     */
    public function show(User $student)
    {
        if ($student->role !== 'student' || $student->created_by !== Auth::id()) {
            abort(404);
        }

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(User $student)
    {
        if ($student->role !== 'student' || $student->created_by !== Auth::id()) {
            abort(404);
        }

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, User $student)
    {
        if ($student->role !== 'student' || $student->created_by !== Auth::id()) {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $student->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'class' => ['required', 'string', 'max:50'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $studentData = [
            'name' => $request->name,
            'email' => $request->email,
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
                // Delete old profile picture if exists
                if ($student->profile_picture) {
                    $oldPath = storage_path('app/public/' . $student->profile_picture);
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
                    $studentData['profile_picture'] = 'profile-pictures/' . $filename;
                } else {
                    // Log error if upload fails
                    \Illuminate\Support\Facades\Log::error('Student profile picture upload failed for: ' . $student->email);
                }
            } catch (\Exception $e) {
                // Log any exceptions during upload
                \Illuminate\Support\Facades\Log::error('Student profile picture upload exception: ' . $e->getMessage());
            }
        }

        $student->update($studentData);

        return redirect()->route('students.index')
                        ->with('success', 'Student information updated successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(User $student)
    {
        if ($student->role !== 'student' || $student->created_by !== Auth::id()) {
            abort(404);
        }

        // Delete profile picture if exists
        if ($student->profile_picture) {
            $oldPath = storage_path('app/public/' . $student->profile_picture);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $student->delete();

        return redirect()->route('students.index')
                        ->with('success', 'Student account deleted successfully!');
    }
}
