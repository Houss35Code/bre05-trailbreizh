@extends('layouts.main')

@section('title', 'Forum')

@section('content')

    <div class="forum-container">

        <div class="forum-header">
            <h1 class="forum-title">Forum</h1>
            @auth
                <a href="{{ route('forum.create') }}" class="forum-new-btn">Nouveau sujet</a>
            @endauth
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="forum-list">
            @forelse($topics as $topic)
                <div class="topic-row">
                    <div>
                        <span class="topic-category">{{ ucfirst($topic->categorie) }}</span>
                        <a href="{{ route('forum.show', $topic) }}" class="topic-link">
                            {{ $topic->titre }}
                        </a>
                        <div class="topic-meta">
                            Par {{ $topic->user->name }} · {{ $topic->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="topic-replies">
                        <div class="topic-replies-count">{{ $topic->reponses->count() }}</div>
                        <div class="topic-replies-label">réponses</div>
                    </div>
                </div>
            @empty
                <div class="forum-empty">
                    Aucun sujet pour le moment. Soyez le premier à poster !
                </div>
            @endforelse
        </div>

        <div class="forum-pagination">
            {{ $topics->links() }}
        </div>

    </div>

@endsection