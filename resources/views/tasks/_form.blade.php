{{-- resources/views/tasks/_form.blade.php --}}
{{-- Shared by Add and Edit modals.
     When used in Edit, JS pre-fills values via openEditModal(). --}}

<div class="form-group">
    <label class="form-label">Task Name <span class="required">*</span></label>
    <input type="text" name="name" class="form-input"
           value="{{ old('name', $task?->task_name) }}"
           placeholder="e.g. Prepare weekly report" required>
    @error('name')<span class="form-error">{{ $message }}</span>@enderror
</div>

<div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-input form-textarea"
              placeholder="Optional details about this task…" rows="3">{{ old('description', $task?->description) }}</textarea>
    @error('description')<span class="form-error">{{ $message }}</span>@enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label class="form-label">Priority <span class="required">*</span></label>
        <select name="priority" class="form-input" required>
            @foreach(['High','Medium','Low'] as $p)
            <option value="{{ $p }}"
                {{ old('priority', $task?->priority) === $p ? 'selected' : '' }}>
                {{ $p }}
            </option>
            @endforeach
        </select>
        @error('priority')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label class="form-label">Deadline <span class="required">*</span></label>
        <input type="date" name="deadline" class="form-input"
               value="{{ old('deadline', $task?->deadline?->format('Y-m-d')) }}"
               required>
        @error('deadline')<span class="form-error">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group">
    <label class="form-label">Status</label>
    <select name="status" class="form-input">
        @foreach(['To Do','In Progress','Completed'] as $s)
        <option value="{{ $s }}"
            {{ old('status', $task?->status ?? 'To Do') === $s ? 'selected' : '' }}>
            {{ $s }}
        </option>
        @endforeach
    </select>
    @error('status')<span class="form-error">{{ $message }}</span>@enderror
</div>