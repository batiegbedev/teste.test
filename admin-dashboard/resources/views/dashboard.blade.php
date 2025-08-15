
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Message de bienvenue --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Bienvenue, {{ auth()->user()->name }} ! Gérez vos recettes et explorez de nouvelles saveurs
                </div>
            </div>

            {{-- Actions rapides dynamiques --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Actions rapides</h3>

                <div x-data="{ open: false }">
                    <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Créer une nouvelle recette
                    </button>

                    <a href="{{ route('recipes.index') }}" class="ml-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                        Voir toutes les recettes
                    </a>

                    {{-- Modal création recette --}}
                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <form method="POST" action="{{ route('recipes.store') }}" class="bg-white p-6 rounded shadow w-96">
                            @csrf
                            <h2 class="text-lg font-bold mb-4">Nouvelle recette</h2>
                            <input type="text" name="title" placeholder="Titre" class="w-full mb-3 border p-2 rounded" required>
                            <textarea name="description" placeholder="Description" class="w-full mb-3 border p-2 rounded" required></textarea>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Enregistrer</button>
                            <button type="button" @click="open = false" class="ml-2 text-gray-600 hover:text-gray-800">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Recettes récentes dynamiques --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recettes récentes</h3>

                @forelse($recipes as $recipe)
                    <div class="mb-4 border-b pb-4">
                        <h4 class="text-md font-bold">{{ $recipe->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $recipe->description }}</p>
                        <p class="text-sm text-gray-500">Difficulté: {{ ucfirst($recipe->difficulty) }}</p>

                        @if($recipe->status === 'published')
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-600 hover:underline">Voir →</a>
                        @else
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-yellow-600 hover:underline">Éditer →</a>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Aucune recette disponible pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>

    
</x-app-layout>
