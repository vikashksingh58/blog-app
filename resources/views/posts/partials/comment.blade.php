
<div class="card mt-4">
    <div class="card-header">
        Comments
    </div>

    <div class="card-body">
        <div class="mb-3 ms-{{ $comment->parent_id ? '4' : '0' }}">
            <strong>{{ $comment->user->name }}</strong>
            <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
            </small>

            <p class="mb-1">{{ $comment->content }}</p>

            <!-- Actions -->
            <div class="mb-2">
                <a href="#reply{{ $comment->id }}"
                data-bs-toggle="collapse"
                class="btn btn-sm btn-link mb-2">
                    Reply
                </a>

                @if($comment->user_id === auth()->id())
                    <a href="#edit{{ $comment->id }}"
                    data-bs-toggle="collapse"
                    class="btn btn-sm btn-link text-warning mb-2">
                        Edit
                    </a>

                    <form method="POST"
                        action="{{ route('comments.destroy', $comment) }}"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-link text-danger mb-2">
                            Delete
                        </button>
                    </form>
                @endif
            </div>

            <!-- Reply Form -->
            <div class="collapse" id="reply{{ $comment->id }}">
                <form method="POST" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea name="content"
                            class="form-control mb-2"
                            rows="2"
                            placeholder="Reply..."
                            required></textarea>
                    <button class="btn btn-sm btn-secondary mb-2">Reply</button>
                </form>
            </div>

            <!-- Edit Form -->
            <div class="collapse" id="edit{{ $comment->id }}">
                <form method="POST" action="{{ route('comments.update', $comment) }}">
                    @csrf
                    @method('PUT')
                    <textarea name="content"
                            class="form-control mb-2"
                            rows="2"
                            required>{{ $comment->content }}</textarea>
                    <button class="btn btn-sm btn-warning mb-2">Update</button>
                </form>
            </div>

            <!-- Replies -->
            @foreach($comment->replies as $reply)
                @include('posts.partials.comment', ['comment' => $reply])
            @endforeach
        </div>
    </div>
</div>
