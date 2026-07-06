@extends('layouts.main')

@section('title', 'Admin — Randonnées')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title" style="margin:0;">Gestion des randonnées</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-list">
            @forelse($randonnees as $randonnee)
                <div class="admin-row">
                    <div>
                        <a href="{{ route('randonnees.show', $randonnee) }}" class="admin-row-link">
                            {{ $randonnee->titre }}
                        </a>
                        <div class="admin-row-meta">
                            Par {{ $randonnee->user->name }} · {{ $randonnee->distance_km }} km · {{ ucfirst($randonnee->difficulte) }} · {{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}
                        </div>
                    </div>
                    <div class="admin-row-actions">
                        <span class="admin-badge">{{ ucfirst($randonnee->statut) }}</span>
                        <form method="POST" action="{{ route('admin.randonnees.delete', $randonnee) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn"
                                onclick="return confirm('Supprimer cette randonnée ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Aucune randonnée.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $randonnees->links() }}</div>

    </div>

@endsection