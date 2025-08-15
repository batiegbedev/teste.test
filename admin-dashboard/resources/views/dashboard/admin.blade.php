@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Titre --}}
    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">
        📊 Dashboard Administrateur
    </h2>

    {{-- Statistiques principales --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $totalRecipes }}</p>
            <p class="text-gray-600 dark:text-gray-300">Recettes totales</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $publishedRecipes }}</p>
            <p class="text-gray-600 dark:text-gray-300">Recettes publiées</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $usersCount }}</p>
            <p class="text-gray-600 dark:text-gray-300">Utilisateurs inscrits</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ number_format($totalViews) }}</p>
            <p class="text-gray-600 dark:text-gray-300">Vues totales</p>
        </div>
    </div>

    {{-- Actions rapides --}}
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('recipes.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
           ➕ Ajouter une recette
        </a>
        <a href="{{ route('admin.users.index') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
           👥 Gérer les utilisateurs
        </a>
        <a href="{{ route('recipes.index') }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
           📂 Gérer les recettes
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Dernières recettes --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
                <h3 class="text-xl font-semibold mb-4">🆕 Dernières recettes ajoutées</h3>
                @forelse($recentRecipes as $recipe)
                    <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0">
                        <h4 class="font-semibold">{{ $recipe->title }}</h4>
                        <p class="text-sm text-gray-500">
                            Difficulté : {{ ucfirst($recipe->difficulty) }} — Statut : {{ $recipe->status }}
                        </p>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ \Illuminate\Support\Str::limit($recipe->description, 80) }}
                        </p>
                        <a href="{{ route('recipes.show', $recipe) }}" 
                           class="text-indigo-600 hover:underline inline-block mt-2">Voir →</a>
                    </div>
                @empty
                    <p class="text-gray-500">Aucune recette récente</p>
                @endforelse
            </div>
        </div>

        {{-- Activité du site --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-4">📌 Activité récente</h3>
            <ul class="space-y-4">
                @forelse($recentActivities as $activity)
                    <li class="flex justify-between border-b pb-2 border-gray-200 dark:border-gray-700">
                        <span>{{ $activity['description'] }}</span>
                        <span class="text-sm text-gray-500">{{ $activity['time'] }}</span>
                    </li>
                @empty
                    <li class="text-gray-500">Aucune activité récente</li>
                @endforelse
            </ul>
        </div>

    </div>

</div>
@endsection
