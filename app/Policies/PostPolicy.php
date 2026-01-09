<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{

    /**
     * Determine if the user can create posts
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine if the user can update the post
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->author_id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the post
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->author_id || $user->isAdmin();
    }

    /**
     * Determine if the user can restore the post
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can permanently delete the post
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
