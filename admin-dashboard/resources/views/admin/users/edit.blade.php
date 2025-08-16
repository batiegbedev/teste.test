@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">➕ Ajouter un utilisateur</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="w-full border rounded" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded" required>
        </div>

        <div>
            <label for="role">Rôle</label>
            <select name="role" id="role" class="w-full border rounded">
                <option value="admin">Admin</option>
                <option value="editeur">Éditeur</option>
                <option value="abonne">Abonné</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Créer</button>
    </form>
</div>
@endsection
