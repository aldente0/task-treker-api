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
        'status_id',
        'type_id',
        'title',
        'description'
    ];

    // all many-to-one
    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TaskType::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
