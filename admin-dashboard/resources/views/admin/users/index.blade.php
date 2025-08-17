@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">👥 User Management</h1>
        <a href="{{ route('admin.users.create') }}" 
           class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            ➕ New User
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-100">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Role</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @switch($user->role)
                            @case('admin')
                                <span class="inline-block px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                    🔴 Admin
                                </span>
                                @break
                            @case('editeur')
                                <span class="inline-block px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                                    🟡 Editor
                                </span>
                                @break
                            @case('abonne')
                                <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                    🟢 Subscriber
                                </span>
                                @break
                            @default
                                <span class="inline-block px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800">
                                    ⚪ Unknown
                                </span>
                        @endswitch
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.users.show', $user) }}" 
                           class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">👁 View</a>
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">✏ Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                              onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                🗑 Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
