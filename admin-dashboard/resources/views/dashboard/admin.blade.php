@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Title --}}
    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">
        📊 Admin Dashboard
    </h2>

    {{-- Main stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $totalRecipes }}</p>
            <p class="text-gray-600 dark:text-gray-300">Total Recipes</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $publishedRecipes }}</p>
            <p class="text-gray-600 dark:text-gray-300">Published Recipes</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ $usersCount }}</p>
            <p class="text-gray-600 dark:text-gray-300">Registered Users</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
            <p class="text-2xl font-bold">{{ number_format($totalViews) }}</p>
            <p class="text-gray-600 dark:text-gray-300">Total Views</p>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('recipes.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
           ➕ Add a Recipe
        </a>

        <a href="{{ route('admin.users.index') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
           👥 Manage Users
        </a>

        <a href="{{ route('recipes.index') }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
           📂 Manage Recipes
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Latest recipes --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
                <h3 class="text-xl font-semibold mb-4">🆕 Latest Added Recipes</h3>

                {{-- Filter by status --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
                        <option value="">All statuses</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </form>

                @forelse($recentRecipes as $recipe)
                    <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0">
                        <h4 class="font-semibold">{{ $recipe->title }}</h4>

                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span>Difficulty: {{ ucfirst($recipe->difficulty) }}</span>

                            @if ($recipe->status === 'published')
                                <span class="inline-flex items-center bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                    ✅ Published
                                </span>
                            @else
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                                    📝 Draft
                                </span>
                            @endif

                            <button onclick="toggleStatus({{ $recipe->id }})"
                                    class="ml-2 text-xs bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded">
                                🔄 Toggle
                            </button>
                        </div>

                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ \Illuminate\Support\Str::limit($recipe->description, 80) }}
                        </p>
                        <a href="{{ route('recipes.show', $recipe) }}" 
                           class="text-indigo-600 hover:underline inline-block mt-2">View →</a>
                    </div>
                @empty
                    <p class="text-gray-500">No recent recipes</p>
                @endforelse
            </div>
        </div>

        {{-- Site activity --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-4">📌 Recent Activity</h3>
            <ul class="space-y-4">
                @forelse($recentActivities as $activity)
                    <li class="flex justify-between border-b pb-2 border-gray-200 dark:border-gray-700">
                        <span>{{ $activity['description'] }}</span>
                        <span class="text-sm text-gray-500">{{ $activity['time'] }}</span>
                    </li>
                @empty
                    <li class="text-gray-500">No recent activity</li>
                @endforelse
            </ul>
        </div>

    </div>

</div>

{{-- Script pour le bouton Toggle --}}
<script>
function toggleStatus(recipeId) {
    fetch(`/recipes/${recipeId}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(() => alert('Une erreur est survenue.'));
}
</script>
@endsection
