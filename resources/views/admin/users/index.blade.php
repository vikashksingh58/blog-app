@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-2">
    <!-- Header -->
    <div class="flex justify-between items-center p-4 border-b">
        <h2 class="text-xl font-semibold">Users</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th class="p-2">Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key=>$user)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'user')
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                Regular User
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                Administrator
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="text-blue-600 hover:underline">
                            Edit
                        </a>
                        <form method="POST"
                                action="{{ route('admin.users.destroy', $user) }}"
                                class="inline">
                            @csrf @method('DELETE')
                            <button
                                onclick="return confirm('Delete this user?')"
                                class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        No Users found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
        <!-- Pagination -->
        <div class="p-4 border-t">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
