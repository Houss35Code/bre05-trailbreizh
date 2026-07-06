@extends('layouts.main')

@section('title', 'Admin — Utilisateurs')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title" style="margin:0;">Gestion des utilisateurs</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="admin-list">
            @forelse($utilisateurs as $utilisateur)
                <div class="admin-row">
                    <div class="user-info">
                        <span class="user-avatar">{{ strtoupper(substr($utilisateur->name, 0, 1)) }}</span>
                        <div>
                            <div class="user-name">
                                {{ $utilisateur->name }}
                                @if($utilisateur->role === 'admin')
                                    <span class="user-admin-badge">Admin</span>
                                @endif
                            </div>
                            <div class="user-meta">
                                {{ $utilisateur->email }} · Inscrit {{ $utilisateur->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    @if($utilisateur->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.utilisateurs.delete', $utilisateur) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn"
                                onclick="return confirm('Supprimer cet utilisateur ?')">
                                Supprimer
                            </button>
                        </form>
                    @else
                        <span class="user-own-label">Votre compte</span>
                    @endif
                </div>
            @empty
                <div class="admin-empty">Aucun utilisateur.</div>
            @endforelse
        </div>

        <div class="admin-pagination">{{ $utilisateurs->links() }}</div>

    </div>

@endsection