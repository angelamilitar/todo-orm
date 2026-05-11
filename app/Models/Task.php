<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'task_name',
        'description',
        'priority',
        'deadline',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByPriority($query, $priority)
    {
        if ($priority && $priority !== 'All') {
            return $query->where('priority', $priority);
        }
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        $dateFilters = ['overdue', 'today', 'tomorrow', 'next5'];
        if ($status && $status !== 'All' && !in_array($status, $dateFilters)) {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeByDateFilter($query, $status, $today)
    {
        if ($status === 'overdue') {
            return $query->where('status', '!=', 'Completed')
                         ->where('deadline', '<', $today);
        }
        if ($status === 'today') {
            return $query->where('status', '!=', 'Completed')
                         ->whereDate('deadline', $today);
        }
        if ($status === 'tomorrow') {
            return $query->where('status', '!=', 'Completed')
                         ->whereDate('deadline', now()->addDay()->toDateString());
        }
        if ($status === 'next5') {
            return $query->where('status', '!=', 'Completed')
                         ->whereDate('deadline', '>=', $today)
                         ->whereDate('deadline', '<=', now()->addDays(5)->toDateString());
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('task_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function getDeadlineLabelAttribute(): ?array
    {
        if ($this->status === 'Completed') return null;
        $today = now()->startOfDay();
        $deadline = $this->deadline->startOfDay();
        $diff = $today->diffInDays($deadline, false);

        if ($diff < 0)   return ['label' => 'OVERDUE',       'color' => 'danger',  'icon' => '⚠'];
        if ($diff === 0) return ['label' => 'DUE TODAY',     'color' => 'warning', 'icon' => '⏰'];
        if ($diff === 1) return ['label' => 'DUE TOMORROW',  'color' => 'purple',  'icon' => '🕐'];
        return ['label' => "{$diff}d left",                  'color' => 'info',    'icon' => '📅'];
    }
}