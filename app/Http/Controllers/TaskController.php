<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isTeacher()) {
            // Teachers see all students' tasks
            $tasks = \App\Models\Task::with('user')->latest()->get();
        } else {
            // Students see only their own tasks
            $tasks = $user->tasks()->latest()->get();
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after:today',
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }

    public function toggleStatus(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed'
        ]);

        return response()->json(['status' => $task->status]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->isTeacher()) {
            $stats = [
                'total_tasks' => \App\Models\Task::count(),
                'completed_tasks' => \App\Models\Task::completed()->count(),
                'pending_tasks' => \App\Models\Task::pending()->count(),
                'high_priority_tasks' => \App\Models\Task::highPriority()->pending()->count(),
            ];
            $recentTasks = \App\Models\Task::with('user')->latest()->take(5)->get();
            $upcomingTasks = \App\Models\Task::where('due_date', '>=', now())->orderBy('due_date')->take(5)->get();
        } else {
            $stats = [
                'total_tasks' => $user->tasks()->count(),
                'completed_tasks' => $user->tasks()->completed()->count(),
                'pending_tasks' => $user->tasks()->pending()->count(),
                'high_priority_tasks' => $user->tasks()->highPriority()->pending()->count(),
            ];
            $recentTasks = $user->tasks()->latest()->take(5)->get();
            $upcomingTasks = $user->tasks()->where('due_date', '>=', now())->orderBy('due_date')->take(5)->get();
        }
        return view('dashboard', compact('stats', 'recentTasks', 'upcomingTasks'));
    }

    // For teachers: list all students
    public function students()
    {
        $user = Auth::user();
        if (!$user->isTeacher()) abort(403);
        $students = \App\Models\User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }
}
