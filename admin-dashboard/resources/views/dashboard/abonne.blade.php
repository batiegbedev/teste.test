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
        display: flex;
        flex-direction: column;
        align-items: center;
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
        display: flex;
        flex-direction: column;
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
        flex: 1;
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
        flex: 1;
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
        transition: background 0.3s;
    }
    .recipe-link:hover {
        background: #b91c1c;
    }
</style>

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Bandeau de bienvenue --}}
    <div class="dashboard-header">
        <h2 class="text-3xl font-bold">🍽️ Dashboard Abonné</h2>
        <p class="mt-1">Bienvenue, {{ auth()->user()->name }} !</p>
    </div>

    {{-- Statistiques rapides avec icônes et animation --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-value" data-target="{{ $recentRecipes->count() }}">0</div>
            <div>Total recettes</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-value" data-target="{{ $recentRecipes->where('status','published')->count() }}">0</div>
            <div>Publiées</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-value" data-target="{{ $recentRecipes->where('status','!=','published')->count() }}">0</div>
            <div>Brouillons</div>
        </div>
    </div>

    {{-- Grille de recettes --}}
    <h4 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">📋 Recettes disponibles</h4>
    <div class="recipes-grid">
        @forelse($recentRecipes as $recipe)
            <div class="recipe-card">
                <img src="{{ asset($recipe->image_path ?? 'images/placeholder.jpg') }}"
                     alt="{{ $recipe->title }}" class="recipe-img">

                <div class="recipe-content">
                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                    <p class="recipe-meta">Difficulté : {{ ucfirst($recipe->difficulty) }}</p>
                    <p class="recipe-desc">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>

                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-link">Voir la recette →</a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucune recette disponible pour le moment.</p>
        @endforelse
    </div>
</div>

{{-- Script animation compteur --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.stat-value');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 50;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 30);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
</script>
@endsection
