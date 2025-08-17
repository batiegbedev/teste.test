@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Title and welcome --}}
    <h2 class="text-3xl font-bold mb-4 text-gray-900">🖋️ Editor Dashboard</h2>
    <p class="mb-6 text-gray-600">Welcome, {{ auth()->user()->name }}!</p>

    {{-- Your latest recipes --}}
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h4 class="text-xl font-semibold mb-4">📋 Your Latest Recipes</h4>

        @forelse($recentRecipes as $recipe)
            <div class="flex items-center justify-between border-b last:border-b-0 pb-4 mb-4">
                <div>
                    <h5 class="text-lg font-semibold text-gray-800">{{ $recipe->title }}</h5>
                    <p class="text-sm text-gray-500">
                        Status: 
                        <span class="inline-block px-2 py-1 text-xs rounded
                            @if($recipe->status === 'published') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($recipe->status) }}
                        </span>
                        &middot; Difficulty: 
                        <span class="inline-block px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            {{ ucfirst($recipe->difficulty) }}
                        </span>
                    </p>
                </div>

                <div class="flex space-x-3">
                    {{-- Link to edit page --}}
                    <a href="{{ route('recipes.edit', $recipe) }}"
                       class="text-indigo-600 hover:text-indigo-800">
                        Edit
                    </a>

                    {{-- Delete form --}}
                    <form action="{{ route('recipes.destroy', $recipe) }}"
                          method="POST"
                          onsubmit="return confirm('Confirm deletion of “{{ addslashes($recipe->title) }}”?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-800">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No recent recipes available.</p>
        @endforelse

        {{-- Link to full index --}}
        @if($recentRecipes->count())
            <div class="mt-6 text-right">
                <a href="{{ route('recipes.index') }}"
                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                    View all your recipes →
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
