@extends('layouts.app')

@section('content')
<style>
    .profile-card {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        padding: 30px;
        font-family: 'Segoe UI', sans-serif;
    }

    .profile-card h2 {
        margin-bottom: 10px;
        font-size: 26px;
        color: #333;
    }

    .profile-card p {
        font-size: 16px;
        color: #555;
        margin: 8px 0;
    }

    .profile-card .label {
        font-weight: bold;
        color: #007bff;
    }

    .profile-card .role {
        display: inline-block;
        background: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<div class="profile-card">
    <h2>Profil de {{ Auth::user()->name }}</h2>
    <p><span class="label">Email :</span> {{ Auth::user()->email }}</p>
    <p><span class="label">Rôle :</span> <span class="role">{{ Auth::user()->role }}</span></p>
</div>
@endsection
