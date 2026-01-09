@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-8">
        <div class="card mt-4">
            <div class="card-header">
                Comments ({{ $post->comments->count() }})
            </div>

            <div class="card-body">

                <!-- Add Comment -->
                <form method="POST" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <textarea name="content"
                            class="form-control mb-2"
                            rows="3"
                            placeholder="Write a comment..."
                            required></textarea>
                    <button class="btn btn-primary btn-sm">Post Comment</button>
                </form>

                <hr>

                <!-- Comments List -->
                @foreach($post->comments->whereNull('parent_id') as $comment)
                    @include('posts.partials.comment', ['comment' => $comment])
                @endforeach

            </div>
        </div>
    </div>
</div>


@endsection


