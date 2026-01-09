@extends('layouts.app')

@section('content')
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection
<div class="container mx-auto mt-4 mx-2">
    <div class="bg-white shadow rounded-lg p-4">
        <h4 class="mb-4">Welcome, {{ auth()->user()->name }}</h4>

        <div class="row mx-2">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h6>Total Posts</h6>
                        <h3>{{ $statistics['total_posts'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h6>Published</h6>
                        <h3>{{ $statistics['published_posts'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-secondary mb-3">
                    <div class="card-body">
                        <h6>Drafts</h6>
                        <h3>{{ $statistics['draft_posts'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="flex justify-between mb-4 mt-4">
        <h1 class="text-2xl font-bold">All Posts</h1>
    </div>

    @foreach($statistics['posts'] as $post)
    <div class="bg-white p-4 rounded shadow mb-3">
        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
        <p class="text-gray-600">{{ Str::limit($post->content,150) }}</p>

        <div class="mt-2">
            <a href="{{ route('posts.show',$post) }}" class="btn btn-sm btn-success">View</a>
        </div>
    </div>
    @endforeach
</div>

@endsection

