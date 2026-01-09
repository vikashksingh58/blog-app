@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-2">

    <!-- Header -->
    <div class="flex justify-between items-center p-4 border-b">
        <h2 class="text-xl font-semibold">Posts</h2>
    </div>

    <!-- Table -->

    <div class="table-responsive">
        <table class="table table-bordered p-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Published</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $key=>$post)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>
                        {{ $post->title }}
                        <div class="text-xs text-gray-500">
                            {{ $post->slug }}
                        </div>
                    </td>
                    <td>{{ $post->author->name ?? 'N/A' }}</td>
                    <td>
                        @if($post->status === 'published')
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                Published
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td>{{ optional($post->published_at)->format('d M Y') ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.posts.destroy', $post) }}"
                              class="inline">
                            @csrf @method('DELETE')
                            <button
                                onclick="return confirm('Delete this post?')"
                                class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        No posts found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
        <!-- Pagination -->
        <div class="p-4 border-t">
            {{ $posts->links() }}
        </div>
    </div>

</div>
@endsection
