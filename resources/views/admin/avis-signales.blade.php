@extends('layouts.main')

@section('title', 'Admin — Avis signalés')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title">Avis signalés</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="admin-list">
            @forelse($avis as $unAvis)
                <div class="admin-row admin-row-signalement">
                    <div>
                        <div class="admin-row-link">
                            {{ $unAvis->randonnee->titre }} — {{ $unAvis->user->name }}
                        </div>
                        <div class="admin-row-meta">
                            Note : {{ $unAvis->note }}/5 · {{ $unAvis->created_at->diffForHumans() }}
                        </div>
                        <p class="signalement-commentaire">« {{ $unAvis->commentaire }} »</p>

                        <div class="signalement-motifs">
                            <strong>Signalé par :</strong>
                            <ul>
                                @foreach($unAvis->signalements as $signalement)
                                    <li>
                                        {{ $signalement->user->name }} — {{ $signalement->motif }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="admin-row-actions admin-row-actions-moderation">
                        <form method="POST" action="{{ route('admin.avis.signale.supprimer', $unAvis) }}"
                            onsubmit="return confirm('Supprimer définitivement cet avis ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn">Supprimer l'avis</button>
                        </form>

                        <form method="POST" action="{{ route('admin.avis.avertir', $unAvis) }}">
                            @csrf
                            <button type="submit" class="admin-warn-btn">Avertir l'auteur</button>
                        </form>

                        @foreach($unAvis->signalements as $signalement)
                            <form method="POST" action="{{ route('admin.signalements.ignorer', $signalement) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="admin-ignore-btn">Ignorer ce signalement</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="admin-empty">Aucun avis signalé.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $avis->links() }}</div>

    </div>

@endsection