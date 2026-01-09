<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-200 flex">

<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <h2 class="font-bold mb-6">Admin Panel</h2>
    <a href="{{ route('admin.dashboard') }}" class="block mb-3">Dashboard</a>
    <a href="{{ route('admin.users.index') }}" class="block mb-3">Users</a>
    <a href="{{ route('admin.posts.index') }}" class="block">Posts</a>
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="btn btn-danger btn-sm w-100 mt-4">
            Logout
        </button>
    </form>
</aside>

<main class="flex-1 p-6">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
