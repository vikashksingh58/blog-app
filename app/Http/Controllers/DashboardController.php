<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function index()
    {
        $statistics = [
            'total_posts' => Post::where('author_id', auth()->id())->count(),
            'published_posts' => Post::where('author_id', auth()->id())->published()->count(),
            'draft_posts' => Post::where('author_id', auth()->id())->draft()->count(),
            'posts' => Post::with(['author', 'comments'])
                ->published()
                ->latest('published_at')
                ->paginate(10)
        ];

        return view('dashboard', compact('statistics'));
    }

}
