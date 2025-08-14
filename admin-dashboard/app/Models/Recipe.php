<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'cooking_time',
        'difficulty',
        'status',
        'user_id',
        'image_path',
        'servings',
    ];

    protected $casts = [
        'cooking_time' => 'integer',
        'servings' => 'integer',
    ];

    /**
     * Get the user that owns the recipe
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for published recipes
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft recipes
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Check if recipe is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if recipe is draft
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Get cooking time in hours and minutes format
     */
    public function getFormattedCookingTimeAttribute(): string
    {
        $hours = floor($this->cooking_time / 60);
        $minutes = $this->cooking_time % 60;
        
        if ($hours > 0) {
            return $hours . 'h' . ($minutes > 0 ? ' ' . $minutes . 'min' : '');
        }
        
        return $minutes . 'min';
    }

    /**
     * Get difficulty level with color
     */
    public function getDifficultyColorAttribute(): string
    {
        return match($this->difficulty) {
            'facile' => 'green',
            'moyen' => 'yellow',
            'difficile' => 'red',
            default => 'gray'
        };
    }
}
