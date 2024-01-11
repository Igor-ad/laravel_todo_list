<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'status',
        'priority',
        'title',
        'description',
        'completed_at',
    ];

    /**
     * recursively return all direct children and all their branches
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id')
            ->with('branches');
    }

    /**
     * return all direct children
     */
    public function children(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    /**
     * return the direct parent
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    /**
     * recursively return all parents
     */
    public function parents(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id')
            ->with('parents');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
