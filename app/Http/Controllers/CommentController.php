<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    // Store new comment

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content'   => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            'user_id'     => auth()->id(),
            'content'     => $validated['content'],
            'parent_id'   => $validated['parent_id'] ?? null,
            'is_approved' => true,
        ]);

        Cache::forget("post.{$post->id}");

        return back()->with('success', 'Comment added successfully!');
    }

    public function update(Request $request, Comment $comment)
    {

        abort_if($comment->user_id !== auth()->id(), 403);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

         // Clear cached post
        Cache::forget("post.{$comment->post_id}");

        return back()->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->delete();
        // Clear cached post
        Cache::forget("post.{$comment->post_id}");
        return back()->with('success', 'Comment deleted.');
    }

}
