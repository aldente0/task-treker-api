<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'project_id',
        'task_status_id',
        'task_type_id',
        'title',
        'description'
    ];

    public function status(): HasOne
    {
        return $this->hasOne(TaskStatus::class);
    }

    public function type(): HasOne
    {
        return $this->hasOne(TaskType::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
