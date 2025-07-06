<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'detailed_description',
        'phase',
        'category',
        'priority',
        'status',
        'estimated_hours',
        'actual_hours',
        'due_date',
        'resources',
        'notes',
        'is_milestone',
        'order_in_phase',
    ];

    protected $casts = [
        'due_date' => 'date',
        'resources' => 'array',
        'is_milestone' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes for filtering
    public function scopeByPhase($query, $phase)
    {
        return $query->where('phase', $phase);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeMilestones($query)
    {
        return $query->where('is_milestone', true);
    }

    public function scopeNotStarted($query)
    {
        return $query->where('status', 'not_started');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public function getPhaseDisplayName()
    {
        return ucfirst(str_replace('_', ' ', $this->phase));
    }

    public function getCategoryDisplayName()
    {
        return ucfirst(str_replace('_', ' ', $this->category));
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'not_started' => 'gray',
            'in_progress' => 'blue',
            'completed' => 'green',
            'reviewed' => 'purple',
            default => 'gray'
        };
    }

    public function getPriorityColor()
    {
        return match($this->priority) {
            'low' => 'green',
            'medium' => 'yellow',
            'high' => 'orange',
            'critical' => 'red',
            default => 'yellow'
        };
    }

    public function isOverdue()
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== 'completed';
    }

    public function getProgressPercentage()
    {
        if ($this->status === 'completed') return 100;
        if ($this->status === 'reviewed') return 100;
        if ($this->status === 'in_progress') return 50;
        return 0;
    }
}
