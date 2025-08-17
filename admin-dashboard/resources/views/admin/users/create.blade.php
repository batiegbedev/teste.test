@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">➕ New User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="editeur" {{ old('role') === 'editeur' ? 'selected' : '' }}>Editor</option>
                <option value="abonne" {{ old('role') === 'abonne' ? 'selected' : '' }}>Subscriber</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit" 
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            💾 Create
        </button>
    </form>
</div>
@endsection
