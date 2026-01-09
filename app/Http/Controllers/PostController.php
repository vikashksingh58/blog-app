<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\BlogService;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    use AuthorizesRequests;

    protected BlogService $blog;

    public function __construct(BlogService $blog)
    {
        $this->blog = $blog;
    }

    // Display posts
    public function index()
    {
        $posts = Post::where('author_id', auth()->id())->with(['author', 'comments'])
            //->published()
            ->latest('published_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    // Show single post
    public function show(Post $post)
    {
        $cacheKey = "post.{$post->id}";
        $post = Cache::remember($cacheKey, 3600, function () use ($post) {
            return Post::with(['author', 'comments.user', 'comments.replies.user'])
                ->findOrFail($post->id);
        });

        return view('posts.show', compact('post'));
    }

    // Show create post form
    public function create(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    // Store new post
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['author_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        // if ($validated['status'] === 'published') {
        //     $validated['published_at'] = now();
        // }
        $post = $this->blog->createPost($validated);
        //$post = Post::create($validated);
        Cache::forget('posts.published');

        return redirect()->route('posts.index', $post)
            ->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the post
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        // Clear cache
        Cache::forget('posts.published');
        Cache::forget("post.{$post->id}");

        return redirect()->route('posts.index', $post)
            ->with('success', 'Post updated successfully!');
    }
    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        $post->delete();
        // Clear cache
        Cache::forget('posts.published');
        Cache::forget("post.{$post->id}");
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }

}
