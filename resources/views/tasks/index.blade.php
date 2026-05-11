@extends('layouts.app')

@section('content')

<div class="tab-content">

    {{-- CUTE BANNER --}}
    <div class="cute-banner mb-4">
      <div class="cute-banner-inner">
        <span class="deco star">⭐</span>
        <span class="deco heart1">💖</span>
        <span class="deco sparkle">✨</span>
        <span class="deco flower">🌸</span>
        <span class="deco star2">🌟</span>
        <span class="deco bear">🐻</span>
        <span class="deco bunny">🐰</span>

        <div class="banner-text-wrap">
          <div class="banner-pill">GET THINGS DONE!</div>
          <h2 class="banner-title">Stay Organized,<br><span>Stay Productive</span></h2>
          <p class="banner-sub">Turn your chaos into checkmarks 💖 Plan your day, track your goals,<br>and celebrate every completed task 🌸📝</p>
          <div class="banner-badges">
            <span class="badge-item">✅ Organize</span>
            <span class="badge-item">⭐ Prioritize</span>
            <span class="badge-item">💙 Achieve</span>
          </div>
        </div>

        <div class="banner-clock">
          <div class="clock-time" id="banner-clock-time">00:00:00</div>
          <div class="clock-date" id="banner-clock-date">Monday, May 11 2026</div>
        </div>

        <div class="banner-note">
          <span>Small<br>steps<br>every day!</span>
          <span class="note-heart">💕</span>
        </div>
      </div>
    </div>

    {{-- ===================== HOME TAB (DASHBOARD) ===================== --}}
    <div class="tab-pane fade show active" id="home">

        @php
            $total      = $tasks->count();
            $todo       = $tasks->where('status', 'To Do')->count();
            $inprogress = $tasks->where('status', 'In Progress')->count();
            $completed  = $tasks->where('status', 'Completed')->count();
            $overdue    = $tasks->filter(fn($t) =>
                              $t->status !== 'Completed' &&
                              \Carbon\Carbon::parse($t->deadline)->isPast()
                          )->count();
            $pct        = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp

        {{-- STAT CARDS --}}
        <div class="dash-stats mb-4">
            <div class="dash-card dash-card--todo">
                <div class="dash-card-icon">📋</div>
                <div class="dash-card-num">{{ $todo }}</div>
                <div class="dash-card-label">To Do</div>
            </div>
            <div class="dash-card dash-card--progress">
                <div class="dash-card-icon">⚡</div>
                <div class="dash-card-num">{{ $inprogress }}</div>
                <div class="dash-card-label">In Progress</div>
            </div>
            <div class="dash-card dash-card--done">
                <div class="dash-card-icon">✅</div>
                <div class="dash-card-num">{{ $completed }}</div>
                <div class="dash-card-label">Completed</div>
            </div>
            <div class="dash-card dash-card--overdue">
                <div class="dash-card-icon">⚠️</div>
                <div class="dash-card-num">{{ $overdue }}</div>
                <div class="dash-card-label">Overdue</div>
            </div>
        </div>

        {{-- PROGRESS BAR --}}
        <div class="dash-progress-wrap mb-4">
            <div class="dash-progress-header">
                <span class="dash-progress-title">🎯 Overall Progress</span>
                <span class="dash-progress-pct">{{ $pct }}% completed</span>
            </div>
            <div class="dash-progress-track">
                <div class="dash-progress-fill" style="width: {{ $pct }}%">
                    @if($pct > 8)
                        <span class="dash-progress-label">{{ $pct }}%</span>
                    @endif
                </div>
            </div>
            <div class="dash-progress-sub">
                {{ $completed }} of {{ $total }} tasks done
                @if($pct === 100) 🎉 Amazing, all done! @elseif($pct >= 50) — keep going! 💪 @else — you've got this! 🌸 @endif
            </div>
        </div>

        {{-- RECENT TASKS PREVIEW --}}
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="mb-0" style="font-weight:800;color:var(--primary)">📌 Recent Tasks</h5>
    <small style="color:var(--text-muted)" id="recentTaskCount">{{ $tasks->count() }} tasks</small>
</div>

            {{-- FILTERS: Search + Dropdowns + Priority Pills --}}
            <div class="recent-filters mb-3">

                {{-- Row 1: Search + Dropdowns --}}
                <div class="recent-top-row">
                    <div class="recent-search-wrap">
                        <i class="fas fa-search recent-search-icon"></i>
                        <input
                            type="text"
                            id="recentTaskSearch"
                            class="recent-search-input"
                            placeholder="Search tasks..."
                            oninput="filterRecentTasks()"
                        >
                    </div>

                    <div class="recent-dropdowns-row">
                        {{-- ALL / OVERDUE --}}
                        <div class="sort-dropdown-wrap">
                            <button class="sort-dropdown-btn" id="allDropdownBtn" onclick="toggleDropdown('allDropdownMenu', 'allChevron')">
                                <span id="allLabel">All</span>
                                <i class="fas fa-chevron-down ms-1" id="allChevron"></i>
                            </button>
                            <div class="sort-dropdown-menu" id="allDropdownMenu">
                                <div class="sort-option active" onclick="setAllFilter('all', 'All', this)">
                                    <i class="fas fa-check me-2 check-icon"></i> All
                                </div>
                                <div class="sort-option" onclick="setAllFilter('overdue', 'Overdue', this)">
                                    Overdue
                                </div>
                            </div>
                        </div>

                        {{-- SORT BY DATES --}}
                        <div class="sort-dropdown-wrap">
                            <button class="sort-dropdown-btn" id="sortDropdownBtn" onclick="toggleDropdown('sortDropdownMenu', 'sortChevron')">
                                <span id="sortLabel">Sort by dates</span>
                                <i class="fas fa-chevron-down ms-1" id="sortChevron"></i>
                            </button>
                            <div class="sort-dropdown-menu" id="sortDropdownMenu">
                                <div class="sort-option-label">Due date</div>
                                <div class="sort-option" onclick="setSortDate('7', 'Next 7 days', this)">Next 7 days</div>
                                <div class="sort-option" onclick="setSortDate('30', 'Next 30 days', this)">Next 30 days</div>
                                <div class="sort-option" onclick="setSortDate('90', 'Next 3 months', this)">Next 3 months</div>
                                <div class="sort-option" onclick="setSortDate('180', 'Next 6 months', this)">Next 6 months</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2: Priority Pills --}}
                <div class="recent-priority-pills">
                    <button class="rpill rpill--all active" data-p="all"    onclick="setRecentPriority('all',this)">All</button>
                    <button class="rpill rpill--high"       data-p="High"   onclick="setRecentPriority('High',this)">🔴 High</button>
                    <button class="rpill rpill--medium"     data-p="Medium" onclick="setRecentPriority('Medium',this)">🟡 Medium</button>
                    <button class="rpill rpill--low"        data-p="Low"    onclick="setRecentPriority('Low',this)">🟢 Low</button>
                </div>

            </div>

            @if($tasks->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-seedling"></i>
                    <p>No tasks yet! 🌱<br><small>Add your first task from Manage Lists.</small></p>
                </div>
            @else
                @php
    $recentGrouped = $tasks->sortBy('deadline')
        ->groupBy(fn($t) => \Carbon\Carbon::parse($t->deadline)->format('Y-m-d'));
@endphp

                <div id="recentTaskList">
                    @foreach($recentGrouped as $dateKey => $dateTasks)
                        @php
                            $dateCarbon  = \Carbon\Carbon::parse($dateKey);
                            $isToday     = $dateCarbon->isToday();
                            $isTomorrow  = $dateCarbon->isTomorrow();
                            $isPast      = $dateCarbon->isPast() && !$isToday;

                            if ($isToday)        $dateLabel = 'Today, ' . $dateCarbon->format('d M Y');
                            elseif ($isTomorrow) $dateLabel = 'Tomorrow, ' . $dateCarbon->format('d M Y');
                            else                 $dateLabel = $dateCarbon->format('l, d M Y');
                        @endphp

                        <div class="recent-date-group"
                             data-date="{{ $dateKey }}"
                             data-past="{{ $isPast ? '1' : '0' }}">

                            <div class="recent-date-header {{ $isPast ? 'date-overdue' : ($isToday ? 'date-today' : '') }}">
                                @if($isPast) ⚠️ @elseif($isToday) 📅 @else 🗓️ @endif
                                {{ $dateLabel }}
                            </div>

                            @foreach($dateTasks as $task)
                                @php
                                    $isOverdue = $task->status !== 'Completed' && \Carbon\Carbon::parse($task->deadline)->isPast();
                                @endphp
                                <div class="recent-task-item"
                                     data-name="{{ strtolower($task->task_name) }}"
                                     data-priority="{{ $task->priority }}"
                                     data-date="{{ $dateKey }}">
                                    <div class="recent-task-left">
                                        <span class="recent-task-status-dot
                                            @if($task->status === 'Completed') dot-done
                                            @elseif($task->status === 'In Progress') dot-progress
                                            @else dot-todo @endif">
                                        </span>
                                        <div>
                                            <div class="recent-task-name">{{ $task->task_name }}</div>
                                            @if($task->description)
                                                <div class="recent-task-desc">{{ Str::limit($task->description, 60) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="recent-task-right">
                                        @if($task->priority === 'High') <span class="badge-high">🔴 High</span>
                                        @elseif($task->priority === 'Medium') <span class="badge-medium">🟡 Medium</span>
                                        @else <span class="badge-low">🟢 Low</span> @endif

                                        <span class="recent-task-deadline {{ $isOverdue ? 'overdue-text' : '' }}">
                                            {{ $isOverdue ? '⚠️ ' : '' }}{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div id="recentNoResults" style="display:none;" class="text-center py-3">
                    <i class="fas fa-search me-1"></i> No tasks match your search 🌸
                </div>
            @endif
        </div>
    </div>

    {{-- TO DO TAB --}}
    <div class="tab-pane fade" id="todo">
        <div class="card p-4">
            <h4 class="mb-3"><i class="fas fa-list me-2 text-warning"></i>To Do Tasks</h4>
            @include('tasks.table', ['filteredTasks' => $tasks->where('status', 'To Do')])
        </div>
    </div>

    {{-- IN PROGRESS TAB --}}
    <div class="tab-pane fade" id="inprogress">
        <div class="card p-4">
            <h4 class="mb-3"><i class="fas fa-spinner me-2 text-primary"></i>In Progress Tasks</h4>
            @include('tasks.table', ['filteredTasks' => $tasks->where('status', 'In Progress')])
        </div>
    </div>

    {{-- COMPLETED TAB --}}
    <div class="tab-pane fade" id="completed">
        <div class="card p-4">
            <h4 class="mb-3"><i class="fas fa-check me-2 text-success"></i>Completed Tasks</h4>
            @include('tasks.table', ['filteredTasks' => $tasks->where('status', 'Completed')])
        </div>
    </div>

    {{-- MANAGE LISTS TAB --}}
    <div class="tab-pane fade" id="manage">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h4 class="mb-0"><i class="fas fa-cogs me-2 text-secondary"></i>Manage All Tasks</h4>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="fas fa-plus me-1"></i> Add Task
                </button>
            </div>
            <p class="manage-hint">✏️ Edit or remove any task directly from this table.</p>
            @include('tasks.table', ['filteredTasks' => $tasks])
        </div>
    </div>

    {{-- ARCHIVE TAB --}}
    <div class="tab-pane fade" id="trash">
        <div class="card p-4">
            <h4 class="mb-3"><i class="fas fa-archive me-2" style="color:var(--primary)"></i>Archive</h4>
            @if($trashedTasks->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Archive is empty 🎉<br><small>Nothing has been removed yet.</small></p>
                </div>
            @else
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
                                <td><div style="font-weight:800;font-size:0.86rem;">{{ $task->task_name }}</div></td>
                                <td>
                                    @if($task->priority=='High') <span class="badge-high">🔴 High</span>
                                    @elseif($task->priority=='Medium') <span class="badge-medium">🟡 Medium</span>
                                    @else <span class="badge-low">🟢 Low</span> @endif
                                </td>
                                <td><div style="font-size:0.82rem;font-weight:700;">{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</div></td>
                                <td><div style="font-size:0.78rem;color:var(--text-muted);">{{ $task->deleted_at?->diffForHumans() }}</div></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn-restore"><i class="fas fa-undo me-1"></i> Restore</button>
                                        </form>
                                        <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Permanently delete this task?')">
                                            @csrf @method('DELETE')
                                            <button class="btn-force"><i class="fas fa-trash me-1"></i> Delete Forever</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>

{{-- ===================== STYLES ===================== --}}
<style>
/* --- Banner --- */
.cute-banner {
  border-radius: 20px;
  background: linear-gradient(135deg, #ffe4f0 0%, #fff0f8 40%, #f0e8ff 100%);
  border: 2px dashed #f9a8d4;
  padding: 28px 32px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 24px rgba(249,168,212,0.25);
}
.cute-banner-inner {
  display: flex;
  align-items: center;
  gap: 24px;
  position: relative;
  z-index: 1;
}
.banner-text-wrap { flex: 1; }
.banner-pill {
  display: inline-block;
  background: #c084fc;
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  padding: 4px 14px;
  border-radius: 999px;
  margin-bottom: 8px;
}
.banner-title {
  font-size: 1.6rem;
  font-weight: 800;
  color: #be185d;
  line-height: 1.2;
  margin-bottom: 8px;
  font-family: 'Georgia', serif;
}
.banner-title span { color: #7c3aed; }
.banner-sub { font-size: 0.85rem; color: #9d174d; margin-bottom: 12px; line-height: 1.6; }
.banner-badges { display: flex; gap: 8px; flex-wrap: wrap; }
.badge-item {
  background: #fff;
  border: 1.5px solid #f9a8d4;
  color: #be185d;
  font-size: 0.75rem;
  font-weight: 600;
  padding: 4px 12px;
  border-radius: 999px;
  box-shadow: 0 2px 6px rgba(249,168,212,0.2);
}
.banner-clock {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  background: rgba(255,255,255,0.55);
  border: 2px solid #f9a8d4;
  border-radius: 16px;
  padding: 16px 22px;
  backdrop-filter: blur(6px);
  box-shadow: 0 4px 16px rgba(249,168,212,0.3);
  min-width: 160px;
}
.clock-time { font-size: 1.8rem; font-weight: 800; color: #be185d; font-family: 'Georgia', serif; letter-spacing: 2px; line-height: 1; }
.clock-date { font-size: 0.72rem; color: #9d174d; font-weight: 600; margin-top: 6px; text-align: center; letter-spacing: 0.5px; }
.banner-note {
  background: #fef08a; border-radius: 10px; padding: 14px 16px;
  font-size: 0.8rem; font-weight: 700; color: #854d0e;
  text-align: center; position: relative;
  box-shadow: 2px 3px 8px rgba(0,0,0,0.08);
  min-width: 80px; transform: rotate(2deg);
}
.banner-note::before {
  content: ''; display: block; width: 20px; height: 6px;
  background: #93c5fd; border-radius: 2px;
  position: absolute; top: -4px; left: 50%; transform: translateX(-50%);
  box-shadow: 0 1px 3px rgba(0,0,0,0.15);
}
.note-heart { display: block; margin-top: 4px; font-size: 1rem; }
.deco { position: absolute; animation: floaty 3s ease-in-out infinite; font-size: 1.2rem; opacity: 0.75; pointer-events: none; }
.star   { top: 8px;  left: 12px; animation-delay: 0s; }
.heart1 { top: 10px; right: 160px; animation-delay: 0.5s; font-size: 1rem; }
.sparkle{ bottom: 10px; left: 60px; animation-delay: 1s; }
.flower { bottom: 8px; right: 200px; animation-delay: 1.5s; }
.star2  { top: 16px; left: 48%; animation-delay: 0.8s; font-size: 1rem; }
.bear   { bottom: 6px; right: 120px; animation-delay: 0.3s; font-size: 1.4rem; }
.bunny  { top: 8px; right: 120px; animation-delay: 1.2s; font-size: 1.3rem; }
@keyframes floaty {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50%       { transform: translateY(-6px) rotate(5deg); }
}

/* --- Dashboard Stat Cards --- */
.dash-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
@media (max-width: 768px) { .dash-stats { grid-template-columns: repeat(2, 1fr); } }
.dash-card {
  border-radius: 16px; padding: 20px 18px; text-align: center;
  font-weight: 700; position: relative; overflow: hidden;
  box-shadow: 0 4px 16px rgba(0,0,0,0.07);
  transition: transform 0.2s, box-shadow 0.2s;
}
.dash-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
.dash-card-icon  { font-size: 1.8rem; margin-bottom: 6px; }
.dash-card-num   { font-size: 2rem; font-weight: 900; line-height: 1; margin-bottom: 4px; }
.dash-card-label { font-size: 0.78rem; letter-spacing: 0.5px; opacity: 0.85; }
.dash-card--todo     { background: linear-gradient(135deg, #fef9c3, #fde68a); color: #92400e; border: 1.5px solid #fcd34d; }
.dash-card--progress { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; border: 1.5px solid #93c5fd; }
.dash-card--done     { background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; border: 1.5px solid #86efac; }
.dash-card--overdue  { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; border: 1.5px solid #fca5a5; }

/* --- Progress Bar --- */
.dash-progress-wrap {
  background: linear-gradient(135deg, #fff0f8, #f5f3ff);
  border: 2px solid #f9a8d4; border-radius: 18px;
  padding: 20px 24px; box-shadow: 0 4px 16px rgba(249,168,212,0.2);
}
.dash-progress-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.dash-progress-title  { font-weight: 800; font-size: 1rem; color: #be185d; }
.dash-progress-pct    { font-weight: 700; font-size: 0.85rem; color: #7c3aed; }
.dash-progress-track  {
  width: 100%; height: 22px;
  background: rgba(249,168,212,0.25);
  border-radius: 999px; overflow: hidden;
  border: 1.5px solid #f9a8d4;
}
.dash-progress-fill {
  height: 100%; min-width: 2%;
  background: linear-gradient(90deg, #f472b6, #c084fc, #818cf8);
  border-radius: 999px;
  display: flex; align-items: center; justify-content: flex-end;
  padding-right: 10px;
  transition: width 1s cubic-bezier(.4,0,.2,1);
  animation: progressGlow 2s ease-in-out infinite alternate;
}
@keyframes progressGlow {
  from { box-shadow: 0 0 8px rgba(244,114,182,0.4); }
  to   { box-shadow: 0 0 18px rgba(192,132,252,0.7); }
}
.dash-progress-label { font-size: 0.7rem; font-weight: 800; color: #fff; text-shadow: 0 1px 3px rgba(0,0,0,0.3); }
.dash-progress-sub   { margin-top: 8px; font-size: 0.8rem; color: #9d174d; font-weight: 600; }

/* --- Recent Tasks Filters --- */
.recent-filters { display: flex; flex-direction: column; gap: 10px; }
.recent-top-row { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
.recent-search-wrap { flex: 1; min-width: 180px; position: relative; }
.recent-search-icon {
  position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
  color: #f472b6; font-size: 13px; pointer-events: none;
}
.recent-search-input {
  width: 100%; padding: 8px 14px 8px 32px;
  border: 1.5px solid #f9a8d4; border-radius: 999px;
  font-size: 0.83rem; font-weight: 600;
  background: #fff; color: #1a1a2e; outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.recent-search-input:focus { border-color: #db2777; box-shadow: 0 0 0 3px rgba(244,114,182,0.15); }
.recent-search-input::placeholder { color: #f9a8d4; font-weight: 500; }

/* --- Sort Dropdowns --- */
.recent-dropdowns-row { display: flex; gap: 8px; align-items: center; flex-shrink: 0; }
.sort-dropdown-wrap { position: relative; }
.sort-dropdown-btn {
  display: flex; align-items: center; gap: 4px;
  padding: 7px 14px; border-radius: 999px;
  border: 1.5px solid #e5e7eb; background: #fff;
  color: #374151; font-size: 0.8rem; font-weight: 600;
  cursor: pointer; white-space: nowrap; transition: all 0.15s;
}
.sort-dropdown-btn:hover { background: #f9fafb; border-color: #d1d5db; }
.sort-dropdown-btn.selected { background: #4b5563; color: #fff; border-color: #4b5563; }
.sort-dropdown-menu {
  display: none; position: absolute; top: calc(100% + 6px); left: 0;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.10);
  min-width: 170px; z-index: 200; padding: 6px 0; overflow: hidden;
}
.sort-dropdown-menu.open { display: block; }
.sort-option {
  padding: 9px 18px; font-size: 0.83rem; font-weight: 500;
  color: #374151; cursor: pointer; transition: background 0.1s;
  display: flex; align-items: center;
}
.sort-option:hover { background: #f3f4f6; }
.sort-option .check-icon { color: #374151; font-size: 0.75rem; }
.sort-option-label {
  padding: 8px 18px 4px; font-size: 0.72rem; font-weight: 700;
  color: #9ca3af; letter-spacing: 0.4px; text-transform: uppercase;
  border-top: 1px solid #f3f4f6; margin-top: 2px; cursor: default;
}

/* --- Priority Pills --- */
.recent-priority-pills { display: flex; gap: 6px; flex-wrap: wrap; }
.rpill {
  padding: 6px 14px; border-radius: 999px; font-size: 0.78rem; font-weight: 700;
  cursor: pointer; border: 1.5px solid transparent;
  transition: all 0.15s; opacity: 0.55; background: none;
}
.rpill.active { opacity: 1; box-shadow: 0 0 0 2.5px currentColor; }
.rpill--all    { background: #fce7f3; color: #be185d; border-color: #f9a8d4; }
.rpill--high   { background: #fee2e2; color: #991b1b; border-color: #fca5a5; }
.rpill--medium { background: #fef3c7; color: #92400e; border-color: #fcd34d; }
.rpill--low    { background: #dcfce7; color: #166534; border-color: #86efac; }

/* --- Date Group Headers --- */
.recent-date-group { margin-bottom: 4px; }
.recent-date-header {
  font-size: 0.82rem; font-weight: 800; color: #7c3aed;
  padding: 8px 4px 5px;
  border-bottom: 1.5px solid rgba(249,168,212,0.3);
  margin-bottom: 6px; letter-spacing: 0.2px;
}
.recent-date-header.date-today   { color: #db2777; }
.recent-date-header.date-overdue { color: #ef4444; }

/* --- Recent Task Items --- */
.recent-task-item {
  display: flex; align-items: center; justify-content: space-between;
  padding: 12px 16px; border-radius: 12px;
  background: var(--card-bg, #fff);
  border: 1.5px solid rgba(249,168,212,0.3);
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  transition: box-shadow 0.2s;
  margin-bottom: 6px;
}
.recent-task-item:hover { box-shadow: 0 4px 14px rgba(249,168,212,0.25); }
.recent-task-left  { display: flex; align-items: center; gap: 12px; }
.recent-task-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.recent-task-status-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.dot-done     { background: #22c55e; box-shadow: 0 0 6px rgba(34,197,94,0.5); }
.dot-progress { background: #3b82f6; box-shadow: 0 0 6px rgba(59,130,246,0.5); }
.dot-todo     { background: #f59e0b; box-shadow: 0 0 6px rgba(245,158,11,0.5); }
.recent-task-name     { font-weight: 700; font-size: 0.88rem; color: var(--text, #1a1a2e); }
.recent-task-desc     { font-size: 0.75rem; color: var(--text-muted, #9ca3af); margin-top: 2px; }
.recent-task-deadline { font-size: 0.75rem; font-weight: 600; color: var(--text-muted, #9ca3af); }
.overdue-text { color: #ef4444 !important; }

/* --- Manage hint --- */
.manage-hint { font-size: 0.82rem; color: var(--text-muted, #9ca3af); margin-bottom: 16px; font-weight: 600; }
</style>

{{-- ADD TASK MODAL --}}
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
                <h5 class="modal-title text-white"><i class="fas fa-plus-circle me-2"></i>Add New Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Task Name</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Enter task name..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Priority</label>
                        <select name="priority" class="form-select rounded-3" required>
                            <option value="Low">🟢 Low</option>
                            <option value="Medium" selected>🟡 Medium</option>
                            <option value="High">🔴 High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deadline</label>
                        <input type="date" name="deadline" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Enter task description..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-add rounded-3"><i class="fas fa-save me-1"></i>Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT TASK MODAL --}}
<div class="modal fade" id="editModalGlobal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
                <h5 class="modal-title text-white"><i class="fas fa-edit me-2"></i>Edit Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTaskForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Task Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Priority</label>
                        <select name="priority" id="edit-priority" class="form-select rounded-3" required>
                            <option value="Low">🟢 Low</option>
                            <option value="Medium">🟡 Medium</option>
                            <option value="High">🔴 High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deadline</label>
                        <input type="date" name="deadline" id="edit-deadline" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" id="edit-status" class="form-select rounded-3">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" id="edit-description" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit rounded-3">
                        <i class="fas fa-save me-1"></i>Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ── Banner clock ──────────────────────────────────────────────
function updateBannerClock() {
    const now   = new Date();
    let h       = now.getHours();
    const ampm  = h >= 12 ? 'PM' : 'AM';
    h           = h % 12 || 12;
    const hStr  = String(h).padStart(2,'0');
    const m     = String(now.getMinutes()).padStart(2,'0');
    const s     = String(now.getSeconds()).padStart(2,'0');
    const days   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const timeEl = document.getElementById('banner-clock-time');
    const dateEl = document.getElementById('banner-clock-date');
    if (timeEl) timeEl.textContent = `${hStr}:${m}:${s} ${ampm}`;
    if (dateEl) dateEl.textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()} ${now.getFullYear()}`;
}
updateBannerClock();
setInterval(updateBannerClock, 1000);

// ── Edit modal ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editModalGlobal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (e) {
            const btn = e.relatedTarget;
            if (!btn) return;
            document.getElementById('edit-name').value        = btn.getAttribute('data-name');
            document.getElementById('edit-priority').value    = btn.getAttribute('data-priority');
            document.getElementById('edit-deadline').value    = btn.getAttribute('data-deadline');
            document.getElementById('edit-status').value      = btn.getAttribute('data-status');
            document.getElementById('edit-description').value = btn.getAttribute('data-description');
            document.getElementById('editTaskForm').action    = '{{ url("/tasks") }}/' + btn.getAttribute('data-id');
        });
    }
});

// ── Dropdown toggle ───────────────────────────────────────────
function toggleDropdown(menuId, chevronId) {
    const menu    = document.getElementById(menuId);
    const chevron = document.getElementById(chevronId);
    const isOpen  = menu.classList.contains('open');

    document.querySelectorAll('.sort-dropdown-menu.open').forEach(m => m.classList.remove('open'));
    document.querySelectorAll('[id$="Chevron"]').forEach(c => c.style.transform = '');

    if (!isOpen) {
        menu.classList.add('open');
        chevron.style.transform = 'rotate(180deg)';
    }
}

document.addEventListener('click', function (e) {
    if (!e.target.closest('.sort-dropdown-wrap')) {
        document.querySelectorAll('.sort-dropdown-menu.open').forEach(m => m.classList.remove('open'));
        document.querySelectorAll('[id$="Chevron"]').forEach(c => c.style.transform = '');
    }
});

// ── All / Overdue filter ──────────────────────────────────────
let recentAllFilter = 'all';
function setAllFilter(val, label, el) {
    recentAllFilter = val;
    document.getElementById('allLabel').textContent = label;
    document.getElementById('allDropdownBtn').classList.toggle('selected', val !== 'all');

    document.querySelectorAll('#allDropdownMenu .sort-option').forEach(x => {
        x.innerHTML = x.textContent.trim();
    });
    el.innerHTML = '<i class="fas fa-check me-2 check-icon"></i>' + el.textContent.trim();

    document.getElementById('allDropdownMenu').classList.remove('open');
    filterRecentTasks();
}

// ── Sort by dates filter ──────────────────────────────────────
let recentSort = 'all';
function setSortDate(val, label, el) {
    recentSort = val;
    document.getElementById('sortLabel').textContent = label;
    document.getElementById('sortDropdownBtn').classList.add('selected');

    document.querySelectorAll('#sortDropdownMenu .sort-option').forEach(x => x.classList.remove('active'));
    el.classList.add('active');

    document.getElementById('sortDropdownMenu').classList.remove('open');
    filterRecentTasks();
}

// ── Priority pills ────────────────────────────────────────────
let recentPriority = 'all';
function setRecentPriority(p, el) {
    recentPriority = p;
    document.querySelectorAll('.rpill').forEach(x => x.classList.remove('active'));
    el.classList.add('active');
    filterRecentTasks();
}

// ── Combined filter ───────────────────────────────────────────
function filterRecentTasks() {
    const q      = document.getElementById('recentTaskSearch').value.toLowerCase().trim();
    const today  = new Date();
    today.setHours(0, 0, 0, 0);
    const groups = document.querySelectorAll('#recentTaskList .recent-date-group');
    let totalVisible = 0;

    groups.forEach(group => {
        const dateStr  = group.dataset.date;
        const dateObj  = new Date(dateStr + 'T00:00:00');
        const diffDays = Math.floor((dateObj - today) / 86400000);
        const isPast   = group.dataset.past === '1';

        let groupMatch = true;
        if (recentAllFilter === 'overdue') {
            groupMatch = isPast;
        } else if (recentSort === '7') {
            groupMatch = diffDays >= 0 && diffDays <= 7;
        } else if (recentSort === '30') {
            groupMatch = diffDays >= 0 && diffDays <= 30;
        } else if (recentSort === '90') {
            groupMatch = diffDays >= 0 && diffDays <= 90;
        } else if (recentSort === '180') {
            groupMatch = diffDays >= 0 && diffDays <= 180;
        }

        const items = group.querySelectorAll('.recent-task-item');
        let groupVisible = 0;

        items.forEach(item => {
            const name          = item.dataset.name || '';
            const priority      = item.dataset.priority || '';
            const matchSearch   = name.includes(q);
            const matchPriority = recentPriority === 'all' || priority === recentPriority;

            if (matchSearch && matchPriority && groupMatch) {
                item.style.display = '';
                groupVisible++;
            } else {
                item.style.display = 'none';
            }
        });

        group.style.display = groupVisible > 0 ? '' : 'none';
        totalVisible += groupVisible;
    });

    document.getElementById('recentNoResults').style.display = totalVisible === 0 ? 'block' : 'none';

    const countEl = document.getElementById('recentTaskCount');
    if (countEl) countEl.textContent = totalVisible + ' task' + (totalVisible !== 1 ? 's' : '');
}
</script>
@endpush
@endsection