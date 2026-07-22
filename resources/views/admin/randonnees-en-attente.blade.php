@extends('layouts.main')

@section('title', 'Admin — Randonnées en attente')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title">Randonnées en attente de validation</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-list">
            @forelse($randonnees as $randonnee)
                <div class="admin-row admin-row-moderation">
                    <div>
                        <a href="{{ route('randonnees.show', $randonnee) }}" class="admin-row-link">
                            {{ $randonnee->titre }}
                        </a>
                        <div class="admin-row-meta">
                            Par {{ $randonnee->user->name }} · {{ $randonnee->distance_km }} km · {{ ucfirst($randonnee->difficulte) }} · {{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}
                        </div>
                    </div>
                    <div class="admin-row-actions admin-row-actions-moderation">
                        <form method="POST" action="{{ route('admin.randonnees.valider', $randonnee) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="admin-validate-btn">Valider</button>
                        </form>

                        <form method="POST" action="{{ route('admin.randonnees.refuser', $randonnee) }}" class="admin-refuse-form">
                            @csrf
                            @method('PATCH')
                            <textarea name="motif" class="admin-refuse-textarea" placeholder="Motif du refus (obligatoire)" required></textarea>
                            <button type="submit" class="admin-delete-btn">Refuser</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Aucune randonnée en attente.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $randonnees->links() }}</div>

    </div>

@endsection