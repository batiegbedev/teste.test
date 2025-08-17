@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">➕ Add a Recipe</h1>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Ingredients</label>
            <textarea name="ingredients" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Instructions</label>
            <textarea name="instructions" rows="4" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Cooking time (min)</label>
                <input type="number" name="cooking_time" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Servings</label>
                <input type="number" name="servings" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Difficulty</label>
            <select name="difficulty" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                <option value="facile">Easy</option>
                <option value="moyen">Medium</option>
                <option value="difficile">Hard</option>
            </select>
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" name="image_path" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit"
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            ✅ Create Recipe
        </button>
    </form>
</div>
@endsection
