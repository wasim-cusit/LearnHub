<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\LearningTask;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the teacher dashboard
     */
            public function teacherDashboard(): View
    {
        $user = Auth::user();

        if (!$user->isTeacher()) {
            abort(403, 'Access denied. Teachers only.');
        }

        // Get statistics for teacher dashboard
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_tasks_created' => Task::where('user_id', $user->id)->count(),
            'completed_tasks' => Task::where('user_id', $user->id)->where('status', 'completed')->count(),
            'pending_tasks' => Task::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];

        // Get recent tasks created by teacher
        $recentTasks = Task::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get students list
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->take(10)
            ->get();

        return view('dashboard.teacher', compact('stats', 'recentTasks', 'students'));
    }

    /**
     * Show the student dashboard
     */
    public function studentDashboard(): View
    {
        $user = Auth::user();

        if (!$user->isStudent()) {
            abort(403, 'Access denied. Students only.');
        }

        // Get statistics for student dashboard
        $stats = [
            'total_tasks' => Task::count(),
            'completed_tasks' => Task::where('status', 'completed')->count(),
            'pending_tasks' => Task::where('status', 'pending')->count(),
            'learning_progress' => LearningTask::where('status', 'completed')->count(),
        ];

        // Get recent tasks
        $recentTasks = Task::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get learning tasks progress
        $learningTasks = LearningTask::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.student', compact('stats', 'recentTasks', 'learningTasks'));
    }

    /**
     * Redirect to appropriate dashboard based on user role
     */
    public function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}
