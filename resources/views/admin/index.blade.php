@extends('layouts.main')

@section('title', 'Administration')

@section('content')

    <div class="admin-container">

        <h1 class="admin-page-title">Tableau de bord admin</h1>

        <!-- STATS -->
        <div class="admin-stats">
            <div class="admin-stat-block">
                <div class="admin-stat-number">{{ $stats['randonnees'] }}</div>
                <div class="admin-stat-label">Randonnées</div>
                <a href="{{ route('admin.randonnees') }}" class="admin-stat-btn">Gérer</a>
            </div>
            <div class="admin-stat-block">
                <div class="admin-stat-number">{{ $stats['utilisateurs'] }}</div>
                <div class="admin-stat-label">Utilisateurs</div>
                <a href="{{ route('admin.utilisateurs') }}" class="admin-stat-btn">Gérer</a>
            </div>
            <div class="admin-stat-block">
                <div class="admin-stat-number">{{ $stats['avis'] }}</div>
                <div class="admin-stat-label">Avis</div>
                <a href="{{ route('admin.avis') }}" class="admin-stat-btn">Gérer</a>
            </div>
        </div>

        <!-- NAVIGATION ADMIN -->
        <div class="admin-nav-block">
            <h2 class="admin-nav-title">Navigation</h2>
            <div class="admin-nav-links">
                <a href="{{ route('admin.randonnees') }}" class="admin-nav-link">
                    <span class="admin-nav-link-label">Gérer les randonnées</span>
                    <span class="admin-nav-link-arrow">→</span>
                </a>
                <a href="{{ route('admin.utilisateurs') }}" class="admin-nav-link">
                    <span class="admin-nav-link-label">Gérer les utilisateurs</span>
                    <span class="admin-nav-link-arrow">→</span>
                </a>
                <a href="{{ route('admin.avis') }}" class="admin-nav-link">
                    <span class="admin-nav-link-label">Gérer les avis</span>
                    <span class="admin-nav-link-arrow">→</span>
                </a>
            </div>
        </div>

    </div>

@endsection