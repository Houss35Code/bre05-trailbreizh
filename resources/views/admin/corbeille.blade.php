@extends('layouts.main')

@section('title', 'Admin — Corbeille')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title">Corbeille — randonnées supprimées</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-list">
            @forelse($randonnees as $randonnee)
                <div class="admin-row">
                    <div>
                        <span class="admin-row-link">{{ $randonnee->titre }}</span>
                        <div class="admin-row-meta">
                            Par {{ $randonnee->user->name }} · supprimée le {{ $randonnee->deleted_at->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="admin-row-actions">
                        <form method="POST" action="{{ route('admin.randonnees.restaurer', $randonnee->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="admin-validate-btn">Restaurer</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Corbeille vide.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $randonnees->links() }}</div>

    </div>

@endsection