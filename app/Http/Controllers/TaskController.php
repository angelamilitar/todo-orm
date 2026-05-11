<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $today  = now()->toDateString();

        $search   = $request->input('search');
        $priority = $request->input('priority', 'All');
        $status   = $request->input('status',   'All');

        $tasks = Task::forUser($userId)
            ->search($search)
            ->byPriority($priority)
            ->byStatus($status)
            ->byDateFilter($status, $today)
            ->orderByRaw("CASE
                WHEN status != 'Completed' AND deadline < '{$today}' THEN 0
                WHEN deadline = '{$today}' THEN 1
                ELSE 2
            END")
            ->orderBy('deadline')
            ->get();

        $allTasks = Task::forUser($userId)->get();

// Build calendar tasks grouped by date
$calendarTasks = $allTasks->groupBy(fn($t) => $t->deadline->format('Y-m-d'))
    ->map(fn($group) => $group->map(fn($t) => [
        'task_name' => $t->task_name,
        'priority'  => $t->priority,
        'status'    => $t->status,
        'deadline'  => $t->deadline->format('Y-m-d'),
    ])->values())
    ->toArray();
        $trashedTasks = Task::onlyTrashed()->where('user_id', $userId)->get();

        $stats = [
            'all'       => $allTasks->count(),
            'overdue'   => $allTasks->filter(fn($t) => $t->status !== 'Completed' && $t->deadline->lt(now()->startOfDay()))->count(),
            'dueToday'  => $allTasks->filter(fn($t) => $t->status !== 'Completed' && $t->deadline->isToday())->count(),
            'tomorrow'  => $allTasks->filter(fn($t) => $t->status !== 'Completed' && $t->deadline->isTomorrow())->count(),
            'next5'     => $allTasks->filter(fn($t) => $t->status !== 'Completed' && $t->deadline->gte(now()->startOfDay()) && $t->deadline->lte(now()->addDays(5)))->count(),
            'completed' => $allTasks->where('status', 'Completed')->count(),
        ];

        $progress = $stats['all'] > 0
            ? round(($stats['completed'] / $stats['all']) * 100)
            : 0;

        $toast = session('success') ? ['message' => session('success'), 'type' => 'success']
               : (session('error')  ? ['message' => session('error'),   'type' => 'error']
               : null);

        return view('tasks.index', compact(
    'tasks', 'stats', 'progress', 'toast',
    'search', 'priority', 'status', 'trashedTasks', 'calendarTasks'
));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority'    => 'required|in:High,Medium,Low',
            'deadline'    => 'required|date',
            'status'      => 'required|in:To Do,In Progress,Completed',
        ]);

        Task::create([
            'user_id'     => Auth::id(),
            'task_name'   => $request->name,
            'description' => $request->description,
            'priority'    => $request->priority,
            'deadline'    => $request->deadline,
            'status'      => $request->status,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task added successfully! ✨');
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority'    => 'required|in:High,Medium,Low',
            'deadline'    => 'required|date',
            'status'      => 'required|in:To Do,In Progress,Completed',
        ]);

        $task->update([
            'task_name'   => $request->name,
            'description' => $request->description,
            'priority'    => $request->priority,
            'deadline'    => $request->deadline,
            'status'      => $request->status,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully. ✏️');
    }

    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $name = $task->task_name;
        $task->delete(); // soft delete — sets deleted_at

        return redirect()->route('tasks.index')
            ->with('success', "\"$name\" moved to trash. 🗑️");
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $task->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => $task->status === 'Completed'
                ? 'Task marked as completed! 🎉'
                : 'Status updated.',
        ]);
    }

    // ✅ ADDED — Show Trash page
    public function trash()
{
    $trashedTasks = Task::onlyTrashed()
        ->where('user_id', Auth::id())
        ->latest('deleted_at')
        ->get();

    // sidebar needs these
    $tasks = Task::forUser(Auth::id())->get();

    return view('tasks.trash', compact('trashedTasks', 'tasks'));
}

    public function restore($id)
    {
        Task::where('user_id', Auth::id())->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('tasks.index')
            ->with('success', 'Task restored! ♻️');
    }

    public function forceDelete($id)
    {
        Task::where('user_id', Auth::id())->onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task permanently deleted! ❌');
    }
}