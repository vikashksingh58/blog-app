<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        // Create sample posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'slug' => 'getting-started-with-laravel',
                'content' => 'Laravel is a modern PHP framework designed to make web application development fast, secure, and enjoyable. It provides expressive syntax, built-in tools, and a powerful ecosystem that helps developers build scalable applications efficiently.',
                'status' => 'published',
            ],
            [
                'title' => 'Mastering Eloquent ORM',
                'slug' => 'mastering-eloquent-orm',
                'content' => 'Eloquent ORM is Laravel’s built-in Active Record implementation. It allows developers to interact with database tables using expressive, object-oriented syntax, making data retrieval, relationships, and updates simple and intuitive.',
                'status' => 'published',
            ],
            [
                'title' => 'Understanding Laravel Middleware',
                'slug' => 'understanding-laravel-middleware',
                'content' => 'Middleware provides a convenient mechanism for filtering HTTP requests entering your application. It is commonly used for authentication, logging, and role-based access control.',
                'status' => 'published',
            ],
            [
                'title' => 'Building Secure REST APIs with Laravel',
                'slug' => 'building-secure-rest-apis-with-laravel',
                'content' => 'Laravel makes building RESTful APIs easy with features like Sanctum, Passport, and API Resources. These tools help you implement authentication, validation, and data transformation in a clean and maintainable way.',
                'status' => 'published',
            ],
            [
                'title' => 'Laravel Performance Optimization Tips',
                'slug' => 'laravel-performance-optimization-tips',
                'content' => 'Optimizing a Laravel application involves caching, database indexing, queueing, and efficient use of Eloquent. Applying these techniques can significantly improve response time and scalability.',
                'status' => 'draft',
            ],
        ];

        foreach ($posts as $postData) {
            $postData = [
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'content' => $postData['content'],
                'author_id' => $users->random()->id,
                'status' => $postData['status'],
                'published_at' => $postData['status'] === 'published' ? now()->subDays(rand(1, 30)) : null,
            ];
            Post::create($postData);
        }

        // Create additional random posts
        //Post::factory(20)->create();
    }
}
