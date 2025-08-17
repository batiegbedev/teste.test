<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome message --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome, {{ auth()->user()->name }}! Manage your recipes and explore new flavors
                </div>
            </div>

            {{-- Quick actions --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Quick Actions</h3>

                <div x-data="{ open: false }">
                    <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Create a new recipe
                    </button>

                    <a href="{{ route('recipes.index') }}" class="ml-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                        View all recipes
                    </a>

                    {{-- Recipe creation modal --}}
                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <form method="POST" action="{{ route('recipes.store') }}" class="bg-white p-6 rounded shadow w-96">
                            @csrf
                            <h2 class="text-lg font-bold mb-4">New Recipe</h2>
                            <input type="text" name="title" placeholder="Title" class="w-full mb-3 border p-2 rounded" required>
                            <textarea name="description" placeholder="Description" class="w-full mb-3 border p-2 rounded" required></textarea>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
                            <button type="button" @click="open = false" class="ml-2 text-gray-600 hover:text-gray-800">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Recent recipes --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recent Recipes</h3>

                @forelse($recipes as $recipe)
                    <div class="mb-4 border-b pb-4">
                        <h4 class="text-md font-bold">{{ $recipe->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $recipe->description }}</p>
                        <p class="text-sm text-gray-500">Difficulty: {{ ucfirst($recipe->difficulty) }}</p>

                        @if($recipe->status === 'published')
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-600 hover:underline">View →</a>
                        @else
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-yellow-600 hover:underline">Edit →</a>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No recipes available at the moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
