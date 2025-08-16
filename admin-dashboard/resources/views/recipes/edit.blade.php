@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">✏ Modifier la recette</h1>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="title" value="{{ old('title', $recipe->title) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3"
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $recipe->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Ingrédients</label>
            <textarea name="ingredients" rows="3"
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">{{ old('ingredients', $recipe->ingredients) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Instructions</label>
            <textarea name="instructions" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">{{ old('instructions', $recipe->instructions) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Temps de cuisson (min)</label>
                <input type="number" name="cooking_time" value="{{ old('cooking_time', $recipe->cooking_time) }}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Portions</label>
                <input type="number" name="servings" value="{{ old('servings', $recipe->servings) }}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Difficulté</label>
            <select name="difficulty" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                <option value="facile" {{ old('difficulty', $recipe->difficulty) === 'facile' ? 'selected' : '' }}>Facile</option>
                <option value="moyenne" {{ old('difficulty', $recipe->difficulty) === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                <option value="difficile" {{ old('difficulty', $recipe->difficulty) === 'difficile' ? 'selected' : '' }}>Difficile</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Image</label>
            @if($recipe->image_path)
                <img src="{{ asset($recipe->image_path) }}" alt="Image actuelle"
                     class="w-32 h-32 object-cover mb-2 rounded" id="current-image">

                <button type="button" id="delete-image-btn"
                        class="text-red-600 underline text-sm mb-4 block">
                    🗑 Supprimer l’image actuelle
                </button>
            @endif
            <input type="file" name="image_path" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            💾 Enregistrer les modifications
        </button>
    </form>
</div>

<script>
document.querySelector('input[name="image_path"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const previewUrl = URL.createObjectURL(file);
        const imageContainer = document.querySelector('#current-image');

        if (imageContainer) {
            imageContainer.src = previewUrl;
        } else {
            const preview = document.createElement('img');
            preview.src = previewUrl;
            preview.className = 'w-32 h-32 object-cover mb-2 rounded';
            preview.id = 'current-image';
            event.target.insertAdjacentElement('beforebegin', preview);
        }
    }
});

document.getElementById('delete-image-btn')?.addEventListener('click', function () {
    if (confirm("Voulez-vous vraiment supprimer l’image actuelle ?")) {
        const image = document.getElementById('current-image');
        if (image) image.remove();

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_image';
        input.value = '1';
        document.querySelector('form').appendChild(input);

        document.getElementById('delete-image-btn').remove();
    }
});
</script>
@endsection
