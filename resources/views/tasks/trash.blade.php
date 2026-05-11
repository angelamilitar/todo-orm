@extends('layouts.app')

@section('content')

<div class="fade-in">

    {{-- Header --}}
    <div class="topbar mb-4">
        <div>
            <div class="topbar-title">🗂️ <span>Archive</span></div>
            <div class="topbar-sub">Tasks you've removed — restore or permanently delete them</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-custom alert-dismissible fade show mb-3">
            <i class="fas fa-check-circle me-2" style="color:var(--primary)"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($trashedTasks->isEmpty())
        <div class="task-card">
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Archive is empty 🎉<br><small>Nothing has been removed yet.</small></p>
            </div>
        </div>
    @else
        <div class="task-card">
            <div class="task-card-title">
                <i class="fas fa-archive" style="color:var(--primary)"></i>
                Archived Tasks
                <span style="background:rgba(var(--primary-rgb),0.1);color:var(--primary);border-radius:20px;padding:2px 10px;font-size:0.75rem;margin-left:4px;">
                    {{ $trashedTasks->count() }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Archived</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedTasks as $index => $task)
                        <tr style="animation-delay: {{ $index * 0.05 }}s">
                            <td><strong style="color:var(--primary)">{{ $index + 1 }}</strong></td>

                            <td>
                                <div style="font-weight:800;font-size:0.86rem;color:var(--text-primary);">
                                    {{ $task->task_name }}
                                </div>
                            </td>

                            <td>
                                @if($task->priority == 'High')
                                    <span class="badge-high">🔴 High</span>
                                @elseif($task->priority == 'Medium')
                                    <span class="badge-medium">🟡 Medium</span>
                                @else
                                    <span class="badge-low">🟢 Low</span>
                                @endif
                            </td>

                            <td>
                                <div style="font-size:0.82rem;font-weight:700;color:var(--text-primary);">
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                </div>
                            </td>

                            <td>
                                <div style="font-size:0.78rem;font-weight:600;color:var(--text-muted);">
                                    {{ $task->deleted_at?->diffForHumans() ?? 'N/A' }}
                                </div>
                            </td>

                            <td>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                    {{-- Restore --}}
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button class="btn-restore">
                                            <i class="fas fa-undo me-1"></i> Restore
                                        </button>
                                    </form>

                                    {{-- Permanently Delete --}}
                                    <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Permanently delete \'{{ addslashes($task->task_name) }}\'? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-force">
                                            <i class="fas fa-trash me-1"></i> Delete Forever
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@endsection