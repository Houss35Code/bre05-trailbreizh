@extends('layouts.main')

@section('title', 'Admin — Avis')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title" style="margin:0;">Gestion des avis</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-list">
            @forelse($avis as $unAvis)
                <div class="admin-row">
                    <div>
                        <div class="avis-admin-author">
                            {{ $unAvis->user->name }}
                            <span class="avis-admin-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $unAvis->note ? '⭐' : '☆' }}
                                @endfor
                            </span>
                        </div>
                        <div class="avis-admin-meta">
                            Sur <a href="{{ route('randonnees.show', $unAvis->randonnee) }}" class="avis-admin-link">{{ $unAvis->randonnee->titre }}</a>
                            · {{ $unAvis->created_at->diffForHumans() }}
                        </div>
                        <p class="avis-admin-text">{{ $unAvis->commentaire }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.avis.delete', $unAvis) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-delete-btn"
                            onclick="return confirm('Supprimer cet avis ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            @empty
                <div class="admin-empty">Aucun avis.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $avis->links() }}</div>

    </div>

@endsection