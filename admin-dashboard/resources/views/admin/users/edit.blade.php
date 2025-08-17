@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">✏️ Modify User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="w-full border rounded" required
                   value="{{ old('name', $user->name) }}">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded" required
                   value="{{ old('email', $user->email) }}">
        </div>

        <div>
            <label for="role">Role</label>
            <select name="role" id="role" class="w-full border rounded">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="editeur" {{ old('role', $user->role) === 'editeur' ? 'selected' : '' }}>Editor</option>
                <option value="abonne" {{ old('role', $user->role) === 'abonne' ? 'selected' : '' }}>Subscriber</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
