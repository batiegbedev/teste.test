@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 animate-fadeIn">

    <!-- Title -->
    <h1 class="text-4xl md:text-5xl font-extrabold text-center text-amber-900 mb-6 tracking-tight">
        {{ $recipe->title }}
    </h1>

    <!-- Main image with effect -->
    @if($recipe->image_path)
        <div class="relative overflow-hidden rounded-2xl shadow-lg group mb-10">
            <img src="{{ asset($recipe->image_path) }}" alt="{{ $recipe->title }}"
                 class="w-full h-[400px] md:h-[500px] object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <span class="absolute bottom-4 left-4 px-4 py-2 bg-rose-600 text-white rounded-full shadow-lg text-sm">
                🍫 Gourmet Recipe
            </span>
        </div>
    @endif

    <!-- Main Info -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
        <div class="info-card">
            ⏱ <span>Time</span>
            <strong>{{ $recipe->cooking_time }} min</strong>
        </div>
        <div class="info-card">
            🍽 <span>Servings</span>
            <strong>{{ $recipe->servings }}</strong>
        </div>
        <div class="info-card">
            🔥 <span>Difficulty</span>
            <strong class="capitalize">{{ $recipe->difficulty }}</strong>
        </div>
        <div class="info-card">
            👀 <span>Views</span>
            <strong>{{ $recipe->views }}</strong>
        </div>
    </div>

    <!-- Description -->
    <p class="text-lg text-gray-700 mb-10 leading-relaxed text-center max-w-3xl mx-auto">
        {{ $recipe->description }}
    </p>

    <!-- Ingredients -->
    <section class="mb-10">
        <h2 class="section-title">🛒 Ingredients</h2>
        <ul class="list-disc pl-6 space-y-1 text-gray-700">
            @foreach(explode(',', $recipe->ingredients) as $ingredient)
                <li class="hover:translate-x-1 transition">{{ trim($ingredient) }}</li>
            @endforeach
        </ul>
    </section>

    <!-- Instructions -->
    <section class="mb-10">
        <h2 class="section-title">👩‍🍳 Instructions</h2>
        <ol class="list-decimal pl-6 space-y-2 text-gray-700">
            @foreach(explode('.', $recipe->instructions) as $step)
                @if(trim($step) !== '')
                    <li class="hover:text-rose-600 transition">{{ trim($step) }}</li>
                @endif
            @endforeach
        </ol>
    </section>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-4">
        <a href="{{ route('dashboard') }}"
           class="btn-secondary">⬅ Back</a>
        <a href="{{ route('recipes.edit', $recipe) }}"
           class="btn-primary">✏ Edit</a>
    </div>
</div>

<!-- Custom styles for the “gourmet” version -->
<style>
    .animate-fadeIn { animation: fadeIn 0.8s ease-out both; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .info-card {
        background: linear-gradient(135deg, #fff7f7, #ffeaea);
        padding: 1rem;
        text-align: center;
        border-radius: 0.75rem;
        box-shadow: 0 4px 14px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .info-card span { display: block; font-size: 0.85rem; color: #555; }
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #b91c1c;
        margin-bottom: 0.75rem;
    }
    .btn-primary {
        background: linear-gradient(135deg, #d32f2f, #ff6b35);
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    .btn-primary:hover { background: #b91c1c; transform: translateY(-2px); }
    .btn-secondary {
        background: #f3f4f6;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-secondary:hover { background: #e5e7eb; transform: translateY(-2px); }
</style>
@endsection
