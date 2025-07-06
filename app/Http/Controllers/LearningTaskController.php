<?php

namespace App\Http\Controllers;

use App\Models\LearningTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningTaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->isTeacher() ? LearningTask::with('user') : $user->learningTasks();

        // Apply filters
        if ($request->filled('phase')) {
            $query->byPhase($request->phase);
        }
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }
        if ($request->filled('priority')) {
            $query->byPriority($request->priority);
        }

        $tasks = $query->orderBy('phase')
                      ->orderBy('order_in_phase')
                      ->orderBy('created_at')
                      ->get();

        $phases = [
            'fundamentals' => 'Laravel Fundamentals',
            'database' => 'Database & Eloquent ORM',
            'frontend' => 'Views & Frontend',
            'auth' => 'Authentication & Authorization',
            'advanced' => 'Advanced Features',
            'api' => 'API Development',
            'testing' => 'Testing & Deployment',
            'deployment' => 'Performance & Deployment',
            'security' => 'Security & Best Practices',
            'projects' => 'Real-World Projects'
        ];

        $categories = [
            'installation' => 'Installation & Setup',
            'routing' => 'Routing',
            'controllers' => 'Controllers',
            'models' => 'Models & Eloquent',
            'views' => 'Views & Blade',
            'forms' => 'Forms & Validation',
            'authentication' => 'Authentication',
            'authorization' => 'Authorization',
            'file_uploads' => 'File Uploads',
            'caching' => 'Caching',
            'queues' => 'Queues & Jobs',
            'api_development' => 'API Development',
            'testing' => 'Testing',
            'performance' => 'Performance',
            'deployment' => 'Deployment',
            'events' => 'Events & Listeners',
            'notifications' => 'Notifications',
            'commands' => 'Artisan Commands',
            'security' => 'Security',
            'best_practices' => 'Best Practices',
            'integrations' => 'Integrations'
        ];

        return view('learning-tasks.index', compact('tasks', 'phases', 'categories'));
    }

    public function create()
    {
        $phases = [
            'fundamentals' => 'Laravel Fundamentals',
            'database' => 'Database & Eloquent ORM',
            'frontend' => 'Views & Frontend',
            'auth' => 'Authentication & Authorization',
            'advanced' => 'Advanced Features',
            'api' => 'API Development',
            'testing' => 'Testing & Deployment',
            'deployment' => 'Performance & Deployment',
            'security' => 'Security & Best Practices',
            'projects' => 'Real-World Projects'
        ];

        $categories = [
            'installation' => 'Installation & Setup',
            'routing' => 'Routing',
            'controllers' => 'Controllers',
            'models' => 'Models & Eloquent',
            'views' => 'Views & Blade',
            'forms' => 'Forms & Validation',
            'authentication' => 'Authentication',
            'authorization' => 'Authorization',
            'file_uploads' => 'File Uploads',
            'caching' => 'Caching',
            'queues' => 'Queues & Jobs',
            'api_development' => 'API Development',
            'testing' => 'Testing',
            'performance' => 'Performance',
            'deployment' => 'Deployment',
            'events' => 'Events & Listeners',
            'notifications' => 'Notifications',
            'commands' => 'Artisan Commands',
            'security' => 'Security',
            'best_practices' => 'Best Practices',
            'integrations' => 'Integrations'
        ];

        return view('learning-tasks.create', compact('phases', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'phase' => 'required|in:fundamentals,database,frontend,auth,advanced,api,testing,deployment,security,projects',
            'category' => 'required|in:installation,routing,controllers,models,views,forms,authentication,authorization,file_uploads,caching,queues,api_development,testing,performance,deployment,events,notifications,commands,security,best_practices,integrations',
            'priority' => 'required|in:low,medium,high,critical',
            'estimated_hours' => 'nullable|integer|min:1',
            'due_date' => 'nullable|date|after:today',
            'resources' => 'nullable|array',
            'notes' => 'nullable|string',
            'is_milestone' => 'boolean',
            'order_in_phase' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_milestone'] = $request->has('is_milestone');

        LearningTask::create($data);

        return redirect()->route('learning-tasks.index')->with('success', 'Learning task created successfully!');
    }

    public function show(LearningTask $learningTask)
    {
        $this->authorize('view', $learningTask);
        return view('learning-tasks.show', compact('learningTask'));
    }

    public function edit(LearningTask $learningTask)
    {
        $this->authorize('update', $learningTask);

        $phases = [
            'fundamentals' => 'Laravel Fundamentals',
            'database' => 'Database & Eloquent ORM',
            'frontend' => 'Views & Frontend',
            'auth' => 'Authentication & Authorization',
            'advanced' => 'Advanced Features',
            'api' => 'API Development',
            'testing' => 'Testing & Deployment',
            'deployment' => 'Performance & Deployment',
            'security' => 'Security & Best Practices',
            'projects' => 'Real-World Projects'
        ];

        $categories = [
            'installation' => 'Installation & Setup',
            'routing' => 'Routing',
            'controllers' => 'Controllers',
            'models' => 'Models & Eloquent',
            'views' => 'Views & Blade',
            'forms' => 'Forms & Validation',
            'authentication' => 'Authentication',
            'authorization' => 'Authorization',
            'file_uploads' => 'File Uploads',
            'caching' => 'Caching',
            'queues' => 'Queues & Jobs',
            'api_development' => 'API Development',
            'testing' => 'Testing',
            'performance' => 'Performance',
            'deployment' => 'Deployment',
            'events' => 'Events & Listeners',
            'notifications' => 'Notifications',
            'commands' => 'Artisan Commands',
            'security' => 'Security',
            'best_practices' => 'Best Practices',
            'integrations' => 'Integrations'
        ];

        return view('learning-tasks.edit', compact('learningTask', 'phases', 'categories'));
    }

    public function update(Request $request, LearningTask $learningTask)
    {
        $this->authorize('update', $learningTask);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'phase' => 'required|in:fundamentals,database,frontend,auth,advanced,api,testing,deployment,security,projects',
            'category' => 'required|in:installation,routing,controllers,models,views,forms,authentication,authorization,file_uploads,caching,queues,api_development,testing,performance,deployment,events,notifications,commands,security,best_practices,integrations',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:not_started,in_progress,completed,reviewed',
            'estimated_hours' => 'nullable|integer|min:1',
            'actual_hours' => 'nullable|integer|min:1',
            'due_date' => 'nullable|date',
            'resources' => 'nullable|array',
            'notes' => 'nullable|string',
            'is_milestone' => 'boolean',
            'order_in_phase' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_milestone'] = $request->has('is_milestone');

        $learningTask->update($data);

        return redirect()->route('learning-tasks.index')->with('success', 'Learning task updated successfully!');
    }

    public function destroy(LearningTask $learningTask)
    {
        $this->authorize('delete', $learningTask);

        $learningTask->delete();

        return redirect()->route('learning-tasks.index')->with('success', 'Learning task deleted successfully!');
    }

    public function updateStatus(Request $request, LearningTask $learningTask)
    {
        $this->authorize('update', $learningTask);

        $request->validate([
            'status' => 'required|in:not_started,in_progress,completed,reviewed',
            'actual_hours' => 'nullable|integer|min:1',
        ]);

        $learningTask->update([
            'status' => $request->status,
            'actual_hours' => $request->actual_hours,
        ]);

        return response()->json(['status' => $learningTask->status]);
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->isTeacher()) {
            $stats = [
                'total_tasks' => LearningTask::count(),
                'completed_tasks' => LearningTask::completed()->count(),
                'in_progress_tasks' => LearningTask::inProgress()->count(),
                'not_started_tasks' => LearningTask::notStarted()->count(),
                'milestones' => LearningTask::milestones()->count(),
            ];

            $recentTasks = LearningTask::with('user')->latest()->take(5)->get();
            $upcomingTasks = LearningTask::where('due_date', '>=', now())->orderBy('due_date')->take(5)->get();
        } else {
            $stats = [
                'total_tasks' => $user->learningTasks()->count(),
                'completed_tasks' => $user->learningTasks()->completed()->count(),
                'in_progress_tasks' => $user->learningTasks()->inProgress()->count(),
                'not_started_tasks' => $user->learningTasks()->notStarted()->count(),
                'milestones' => $user->learningTasks()->milestones()->count(),
            ];

            $recentTasks = $user->learningTasks()->latest()->take(5)->get();
            $upcomingTasks = $user->learningTasks()->where('due_date', '>=', now())->orderBy('due_date')->take(5)->get();
        }

        $phaseProgress = [];
        $phases = ['fundamentals', 'database', 'frontend', 'auth', 'advanced', 'api', 'testing', 'deployment', 'security', 'projects'];

        foreach ($phases as $phase) {
            if ($user->isTeacher()) {
                $total = LearningTask::byPhase($phase)->count();
                $completed = LearningTask::byPhase($phase)->completed()->count();
            } else {
                $total = $user->learningTasks()->byPhase($phase)->count();
                $completed = $user->learningTasks()->byPhase($phase)->completed()->count();
            }

            $phaseProgress[$phase] = [
                'total' => $total,
                'completed' => $completed,
                'percentage' => $total > 0 ? round(($completed / $total) * 100) : 0
            ];
        }

        return view('learning-tasks.dashboard', compact('stats', 'recentTasks', 'upcomingTasks', 'phaseProgress'));
    }
}
