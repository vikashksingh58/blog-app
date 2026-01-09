{{-- @extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Create Post</h1>

<form method="POST" action="{{ route('posts.store') }}">
@csrf

<input type="text" name="title" placeholder="Title"
 class="w-full border p-2 mb-3">

<textarea name="content" placeholder="Content"
 class="w-full border p-2 mb-3"></textarea>

<button class="bg-green-500 text-white px-4 py-2 rounded">
 Save
</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                Create New Post
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('posts.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Title</label>
                        <input name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Content</label>
                        <textarea name="content" rows="6" class="form-control" required></textarea>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status"
                                class="form-select">
                            <option value="draft">
                                Draft
                            </option>
                            <option value="published">
                                Published
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

