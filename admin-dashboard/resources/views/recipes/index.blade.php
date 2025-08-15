<!-- resources/views/recipes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Toutes les recettes</h1>

    @if(isset($recipes) && $recipes->isEmpty())
        <p>Aucune recette disponible pour le moment.</p>
    @elseif(isset($recipes))
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recipes as $recipe)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    @if($recipe->image_path)
                        <img src="{{ asset($recipe->image_path) }}" alt="{{ $recipe->title }}"
                             class="w-full h-48 object-cover rounded-t-lg">
                    @endif
                    <div class="p-4">
                        <h2 class="font-semibold text-lg mb-2">{{ $recipe->title }}</h2>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $recipe->description }}</p>
                        <a href="{{ route('recipes.show', $recipe) }}"
                           class="inline-block px-3 py-1 bg-rose-600 text-white rounded hover:bg-rose-700">
                            Voir la recette
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(method_exists($recipes, 'links'))
            <div class="mt-8">{{ $recipes->links() }}</div>
        @endif
    @else
        <p class="text-gray-600">La variable $recipes n’a pas été fournie par le contrôleur.</p>
    @endif
</div>
@endsection
