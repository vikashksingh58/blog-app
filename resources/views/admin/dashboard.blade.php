@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="container mx-auto mt-4 mx-2">
    <div class="bg-white shadow rounded-lg p-4">
        <h4 class="mb-4">Welcome, {{ auth()->user()->name }}</h4>

        <div class="row mx-2">
            <div class="col-md-3">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h6>Total Users</h6>
                        <h3>{{ $statistics['total_users'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h6>Total Posts</h6>
                        <h3>{{ $statistics['total_posts'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-secondary mb-3">
                    <div class="card-body">
                        <h6>Published Posts</h6>
                        <h3>{{ $statistics['published_posts'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-secondary mb-3">
                    <div class="card-body">
                        <h6>Total Comments </h6>
                        <h3>{{ $statistics['total_comments'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
