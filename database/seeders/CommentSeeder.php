<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::published()->get();
        $users = User::where('role', 'user')->get();

        foreach ($posts as $post) {
            // Create 2-5 comments per post
            $commentCount = rand(2, 5);

            for ($i = 0; $i < $commentCount; $i++) {
                $comment = Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'content' => 'This is a sample comment #' . ($i + 1) . ' on the post.',
                    'is_approved' => true,
                ]);

                // 50% chance to add a reply
                if (rand(0, 1)) {
                    Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $users->random()->id,
                        'parent_id' => $comment->id,
                        'content' => 'This is a reply to comment #' . ($i + 1),
                        'is_approved' => true,
                    ]);
                }
            }
        }
    }
}
