@extends('layouts.app')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #d32f2f, #ff6b35);
        color: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1rem;
        border-radius: 0.75rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #d32f2f;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    .recipe-card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .recipe-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .recipe-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .recipe-content {
        padding: 1rem;
    }

    .recipe-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #111827;
    }

    .recipe-meta {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .recipe-desc {
        font-size: 0.9rem;
        color: #374151;
    }

    .recipe-link {
        display: inline-block;
        margin-top: 0.75rem;
        padding: 0.4rem 0.8rem;
        background: linear-gradient(135deg, #d32f2f, #ff6b35);
        color: white;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
    }

    .recipe-link:hover {
        background: #b91c1c;
    }
</style>

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Welcome Banner --}}
    <div class="dashboard-header">
        <h2 class="text-3xl font-bold">🍽️ Subscriber Dashboard</h2>
        <p class="mt-1">Welcome, {{ auth()->user()->name }}!</p>
    </div>

   

    {{-- Recipes Grid --}}
    <h4 class="text-xl font-semibold mb-4 text-gray-800">📋 Available Recipes</h4>
    <div class="recipes-grid">
        @forelse($recentRecipes as $recipe)
            <div class="recipe-card">
                <img src="{{ asset($recipe->image_path ?? 'images/placeholder.jpg') }}"
                     alt="{{ $recipe->title }}" class="recipe-img">

                <div class="recipe-content">
                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                    <p class="recipe-meta">Difficulty: {{ ucfirst($recipe->difficulty) }}</p>
                    <p class="recipe-desc">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>

                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-link">View Recipe →</a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No recipes available at the moment.</p>
        @endforelse
    </div>
</div>
@endsection
