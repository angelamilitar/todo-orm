{{-- ✅ ADD THIS BLOCK --}}
<div class="d-flex align-items-center gap-2 flex-wrap mb-3">
    <div class="position-relative flex-grow-1" style="min-width:200px;">
        <i class="fas fa-search position-absolute top-50 translate-middle-y ps-3"
           style="color:var(--primary);opacity:0.5;left:0;pointer-events:none;"></i>
        <input type="text" id="taskSearch"
               placeholder="Search tasks..."
               oninput="filterTasks()"
               style="width:100%;padding:9px 16px 9px 38px;border-radius:50px;border:1.5px solid rgba(var(--primary-rgb),0.3);background:rgba(var(--primary-rgb),0.04);font-size:0.85rem;font-weight:600;color:var(--text);outline:none;" />
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="pill-filter active" data-priority="all"    onclick="setPriority('all',this)">✨ All</button>
        <button class="pill-filter"        data-priority="High"   onclick="setPriority('High',this)">🔴 High</button>
        <button class="pill-filter"        data-priority="Medium" onclick="setPriority('Medium',this)">🟡 Medium</button>
        <button class="pill-filter"        data-priority="Low"    onclick="setPriority('Low',this)">🟢 Low</button>
    </div>
</div>
<div id="noTasksMsg" style="display:none;text-align:center;padding:2rem;color:var(--primary);font-weight:700;font-size:0.9rem;">
    💫 No tasks match your search~
</div>
{{-- ✅ END ADD --}}

<div class="table-responsive">   {{-- ← this line already exists --}}
    
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filteredTasks as $index => $task)
            @php
                $deadline = \Carbon\Carbon::parse($task->deadline);
                $isOverdue = $deadline->startOfDay()->lt(now()->startOfDay()) && $task->status !== 'Completed';
                $isToday = $deadline->isToday();
                $daysLeft = (int) now()->startOfDay()->diffInDays($deadline->startOfDay(), false);
            @endphp
            <tr draggable="true"
                data-id="{{ $task->id }}"
                data-deadline="{{ $task->deadline }}"
                data-status="{{ $task->status }}"
                data-name="{{ strtolower($task->task_name) }}"    {{-- ✅ ADD --}}
                data-priority="{{ $task->priority }}"              {{-- ✅ ADD --}}
                style="animation-delay: {{ $index * 0.05 }}s">
                <td><strong style="color:var(--primary)">{{ $index + 1 }}</strong></td>
                <td>
                    <div style="font-weight:800;font-size:0.86rem;">{{ $task->task_name }}</div>
                    @if($task->description)
                    <div style="font-size:0.75rem;color:#888;font-weight:500;margin-top:2px;">{{ $task->description }}</div>
                    @endif
                    @if($isOverdue)
                        <span style="font-size:0.68rem;color:#ef4444;font-weight:800;">⚠️ OVERDUE</span>
                    @elseif($isToday)
                        <span style="font-size:0.68rem;color:#f59e0b;font-weight:800;">🔥 DUE TODAY</span>
                    @elseif($daysLeft === 1)
                        <span style="font-size:0.68rem;color:#f97316;font-weight:800;">⏰ DUE TOMORROW</span>
                    @elseif($daysLeft <= 5 && $daysLeft > 0)
                        <span style="font-size:0.68rem;color:#3b82f6;font-weight:800;">📅 {{ $daysLeft }}d left</span>
                    @endif
                </td>
                <td>
                    @if($task->priority=='High') <span class="badge-high">🔴 High</span>
                    @elseif($task->priority=='Medium') <span class="badge-medium">🟡 Medium</span>
                    @else <span class="badge-low">🟢 Low</span> @endif
                </td>
                <td>
                    <div style="font-size:0.82rem;font-weight:700;color:{{ $isOverdue ? '#ef4444' : 'var(--text)' }}">
                        {{ $deadline->format('M d, Y') }}
                    </div>
                </td>
                <td>
                    @php
                       $sc = ['To Do'=>'#f59e0b','In Progress'=>'#a855f7','Completed'=>'#10b981'];
                        $c = $sc[$task->status] ?? '#888';
                    @endphp
                    <select class="status-select" onchange="quickStatus({{ $task->id }}, this.value)"
                        style="border-color:{{ $c }}60;color:{{ $c }}">
                        <option value="To Do" {{ $task->status=='To Do'?'selected':'' }}>📋 To Do</option>
                        <option value="In Progress" {{ $task->status=='In Progress'?'selected':'' }}>⚡ In Progress</option>
                        <option value="Completed" {{ $task->status=='Completed'?'selected':'' }}>✅ Completed</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-edit me-1"
                        data-bs-toggle="modal" data-bs-target="#editModalGlobal"
                        data-id="{{ $task->id }}"
                        data-name="{{ $task->task_name }}"
                        data-priority="{{ $task->priority }}"
                        data-deadline="{{ $task->deadline }}"
                        data-status="{{ $task->status }}"
                        data-description="{{ $task->description }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('tasks.destroy',$task->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-remove" onclick="return confirm('Move to trash?')">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <i class="fas fa-heart"></i>
                        <p>No tasks here yet 💕<br><small>Click "Add New Task" to get started!</small></p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ... all your existing table code above ... --}}

{{-- ✅ ADD THIS AT THE BOTTOM --}}
<script>
(function () {
    // Scope to THIS instance of the table only
    const allScripts = document.querySelectorAll('script');
    const thisScript = allScripts[allScripts.length - 1];
    const container  = thisScript.closest('.card') || thisScript.parentElement;

    const searchInput = container.querySelector('[id^="taskSearch"]');
    const noMsg       = container.querySelector('[id^="noTasksMsg"]');

    if (!searchInput) return;

    // Give each input a unique id to avoid conflicts
    const uid = 'ts_' + Math.random().toString(36).slice(2);
    searchInput.id = uid;
    searchInput.setAttribute('oninput', '');

    let activePriority = 'all';

    container.querySelectorAll('.pill-filter').forEach(btn => {
        btn.onclick = function () {
            activePriority = this.dataset.priority;
            container.querySelectorAll('.pill-filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            filterTasks();
        };
    });

    searchInput.addEventListener('input', filterTasks);

    function filterTasks() {
        const query = searchInput.value.toLowerCase().trim();
        const rows  = container.querySelectorAll('tbody tr[data-id]');
        let visible = 0;

        rows.forEach(row => {
            const name     = (row.dataset.name     || '').toLowerCase();
            const priority = (row.dataset.priority || '');
            const matchSearch   = name.includes(query);
            const matchPriority = activePriority === 'all' || priority === activePriority;

            if (matchSearch && matchPriority) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noMsg) noMsg.style.display = visible === 0 ? 'block' : 'none';

        let n = 1;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const numCell = row.querySelector('td:first-child strong');
                if (numCell) numCell.textContent = n++;
            }
        });
    }
})();
</script>