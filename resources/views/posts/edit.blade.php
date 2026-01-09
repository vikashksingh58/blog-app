@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-header ">
                <h5 class="mb-0">Edit Post</h5>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('posts.update', $post) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $post->title) }}"
                               class="form-control @error('title') is-invalid @enderror"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug (Read Only) -->
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $post->slug }}"
                               readonly>
                        <small class="text-muted">
                            Slug is auto-generated and cannot be changed
                        </small>
                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content"
                                  rows="7"
                                  class="form-control @error('content') is-invalid @enderror"
                                  required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Featured Image</label>
                        <input type="file"
                               name="image"
                               class="form-control">

                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}"
                                 class="img-thumbnail mt-2"
                                 width="180">
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status"
                                class="form-select">
                            <option value="draft"
                                {{ $post->status == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="published"
                                {{ $post->status == 'published' ? 'selected' : '' }}>
                                Published
                            </option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.index') }}"
                           class="btn btn-secondary">
                            Back
                        </a>

                        <button type="submit"
                                class="btn btn-success">
                            Update Post
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
