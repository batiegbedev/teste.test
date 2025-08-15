@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">➕ Nouvel utilisateur</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Rôle</label>
            <select name="role" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                <option value="admin">Admin</option>
                <option value="user">Utilisateur</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit" 
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            💾 Créer
        </button>
    </form>
</div>
@endsection
