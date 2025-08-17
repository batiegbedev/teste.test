@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">➕ Add User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="w-full border rounded" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded" required>
        </div>

        <div>
            <label for="role">Role</label>
            <select name="role" id="role" class="w-full border rounded">
                <option value="admin">Admin</option>
                <option value="editeur">Editor</option>
                <option value="abonne">Subscriber</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection
