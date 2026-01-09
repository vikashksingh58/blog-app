<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class BlogService
{
    /**
     * Create a new blog post
     */
    public function createPost(array $data): Post
    {
        return DB::transaction(function () use ($data) {
            return Post::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'author_id' => auth()->id(),
                'status' => $data['status'] ?? 'draft',
                'image' => $data['image'] ?? null,
                'published_at' => $data['status'] === 'published' ? now() : null,
            ]);
        });
    }
}
