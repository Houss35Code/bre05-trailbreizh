@extends('layouts.main')

@section('title', $topic->titre)

@section('content')

    <div class="forum-show-container">

        <!-- FIL D'ARIANE -->
        <div class="breadcrumb">
            <a href="/" class="breadcrumb-link">Accueil</a>
            &rsaquo;
            <a href="{{ route('forum.index') }}" class="breadcrumb-link">Forum</a>
            &rsaquo;
            <span>{{ $topic->titre }}</span>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <!-- SUJET PRINCIPAL -->
        <div class="topic-block">
            <div class="topic-block-header">
                <div>
                    <span class="topic-category">{{ ucfirst($topic->categorie) }}</span>
                    <h1 class="topic-block-title">{{ $topic->titre }}</h1>
                    <div class="topic-block-meta">
                        Par <strong>{{ $topic->user->name }}</strong> · {{ $topic->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <p class="topic-block-content">{{ $topic->contenu }}</p>
        </div>

        <!-- RÉPONSES -->
        <h2 class="reponses-title">{{ $topic->reponses->count() }} réponse(s)</h2>

        @foreach($topic->reponses as $reponse)
            <div class="reponse-block">
                <div class="reponse-header">
                    <div class="reponse-meta">
                        <strong class="reponse-author">{{ $reponse->user->name }}</strong>
                        · {{ $reponse->created_at->diffForHumans() }}
                    </div>
                    @auth
                        @if(auth()->id() === $reponse->user_id)
                            <form method="POST" action="{{ route('reponses.destroy', $reponse) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="reponse-delete-btn">Supprimer</button>
                            </form>
                        @endif
                    @endauth
                </div>
                <p class="reponse-content">{{ $reponse->contenu }}</p>
            </div>
        @endforeach

        <!-- FORMULAIRE RÉPONSE -->
        @auth
            <div class="reponse-form-block">
                <h3 class="reponse-form-title">Répondre</h3>
                <form method="POST" action="{{ route('forum.reponses.store', $topic) }}">
                    @csrf
                    <textarea name="contenu" rows="4" placeholder="Votre réponse..."
                        class="reponse-textarea" required>{{ old('contenu') }}</textarea>
                    <button type="submit" class="reponse-submit-btn">Publier la réponse</button>
                </form>
            </div>
        @else
            <div class="forum-login-alert">
                <p class="forum-login-alert-text">
                    <a href="{{ route('login') }}" class="forum-login-link">Connectez-vous</a>
                    pour répondre à ce sujet.
                </p>
            </div>
        @endauth

        <a href="{{ route('forum.index') }}" class="forum-back-link">← Retour au forum</a>

    </div>

@endsection