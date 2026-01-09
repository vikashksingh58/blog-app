@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card shadow-sm">
                <div class="card-header ">
                    <h5 class="mb-0">Edit Post</h5>
                </div>

                <div class="card-body">
                    <form method="POST"
                          action="{{ route('admin.posts.update', $post) }}"
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

                        <!-- Slug (Editable for Admin) -->
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text"
                                   name="slug"
                                   value="{{ old('slug', $post->slug) }}"
                                   class="form-control @error('slug') is-invalid @enderror"
                                   disabled>

                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                        <!-- Author -->


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

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.posts.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Update Post
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
