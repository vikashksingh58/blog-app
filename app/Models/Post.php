<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Mass assignable attributes
    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id',
        'image',
        'published_at',
        'status',
    ];

    // Attribute casting
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Boot method for model events

    protected static function boot()
    {
        parent::boot();

        // Create slug on create
        static::creating(function ($post) {
            $post->slug = self::generateUniqueSlug($post->title);
        });

        // Update slug only if title changes
        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = self::generateUniqueSlug(
                    $post->title,
                    $post->id
                );
            }
        });
    }

    protected static function generateUniqueSlug(string $title, $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {

            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }


    // Use slug for route model binding
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Query Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Helper Methods
    public function canBeEditedBy(User $user): bool
    {
        return $user->isAdmin() || $this->author_id === $user->id;
    }
}
