@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4 mx-2">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">My Posts</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-gray-800 px-4 py-2 rounded">
            Create Post
        </a>
    </div>

    @foreach($posts as $post)
    <div class="bg-white p-4 rounded shadow mb-3">
        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
        <p class="text-gray-600">{{ Str::limit($post->content,150) }}</p>

        <div class="mt-2">
            <a href="{{ route('posts.edit',$post) }}" class="text-blue-500">Edit</a>
            <form action="{{ route('posts.destroy',$post) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500 ml-2">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
