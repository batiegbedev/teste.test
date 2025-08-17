@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            👤 User Profile
        </h1>
        <a href="{{ route('admin.users.index') }}" 
           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
            ⬅ Back to list
        </a>
    </div>

    {{-- User Card --}}
    <div class="bg-white shadow rounded-lg p-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-semibold text-gray-500">Name</p>
                <p class="text-lg text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Email</p>
                <p class="text-lg text-gray-800">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Role</p>
                <span class="inline-block px-3 py-1 text-sm rounded-full 
                             {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Created at</p>
                <p class="text-lg text-gray-800">{{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-8 flex gap-4">
        <a href="{{ route('admin.users.edit', $user) }}" 
           class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ✏ Edit
        </a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
              onsubmit="return confirm('Delete this user?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                🗑 Delete
            </button>
        </form>
    </div>

</div>
@endsection
