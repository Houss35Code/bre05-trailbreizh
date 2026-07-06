@extends('layouts.main')

@section('title', 'Mon espace')

@section('content')

    <div class="dashboard-container">

        <div class="dashboard-welcome">
            <h1 class="dashboard-welcome-title">Bonjour, {{ auth()->user()->name }} !</h1>
            <p class="dashboard-welcome-text">Bienvenue sur votre espace personnel TrailBreizh</p>
        </div>

        <!-- MES RANDONNÉES -->
        <div class="dashboard-block">
            <div class="dashboard-header">
                <h2 class="dashboard-block-title dashboard-block-title--inline">Mes randonnées</h2>
                <a href="{{ route('randonnees.create') }}" class="dashboard-add-btn">
                    Ajouter une randonnée
                </a>
            </div>

            @forelse(auth()->user()->randonnees()->latest()->get() as $randonnee)
                <div class="dashboard-item">
                    <div>
                        <a href="{{ route('randonnees.show', $randonnee) }}" class="dashboard-item-link">
                            {{ $randonnee->titre }}
                        </a>
                        <div class="dashboard-item-meta">
                            {{ $randonnee->distance_km }} km · {{ ucfirst($randonnee->difficulte) }} · {{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}
                        </div>
                    </div>
                    <span class="dashboard-item-badge">{{ ucfirst($randonnee->statut) }}</span>
                </div>
            @empty
                <p class="dashboard-empty">Vous n'avez pas encore ajouté de randonnée.</p>
            @endforelse
        </div>

        <!-- MES FAVORIS -->
        <div class="dashboard-block">
            <h2 class="dashboard-block-title">Mes favoris</h2>

            @forelse(auth()->user()->favoris()->with('randonnee')->latest()->get() as $favori)
                <div class="dashboard-item">
                    <div>
                        <a href="{{ route('randonnees.show', $favori->randonnee) }}" class="dashboard-item-link">
                            {{ $favori->randonnee->titre }}
                        </a>
                        <div class="dashboard-item-meta">
                            {{ $favori->randonnee->distance_km }} km · {{ ucfirst($favori->randonnee->difficulte) }}
                        </div>
                    </div>
                    <form method="POST" action="{{ route('favoris.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="randonnee_id" value="{{ $favori->randonnee->id }}">
                        <button type="submit" class="dashboard-remove-btn">Retirer</button>
                    </form>
                </div>
            @empty
                <p class="dashboard-empty">Vous n'avez pas encore de randonnée en favori.</p>
            @endforelse
        </div>

        <!-- MES AVIS -->
        <div class="dashboard-block">
            <h2 class="dashboard-block-title">Mes avis</h2>

            @forelse(auth()->user()->avis()->with('randonnee')->latest()->get() as $avis)
                <div class="dashboard-item dashboard-item--column">
                    <div class="dashboard-header dashboard-header--tight">
                        <a href="{{ route('randonnees.show', $avis->randonnee) }}" class="dashboard-item-link">
                            {{ $avis->randonnee->titre }}
                        </a>
                        <div class="avis-row">
                            <span class="avis-stars-small">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $avis->note ? '⭐' : '☆' }}
                                @endfor
                            </span>
                            <span class="avis-date-small">{{ $avis->created_at->diffForHumans() }}</span>
                            <form method="POST" action="{{ route('avis.destroy', $avis) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dashboard-remove-btn">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    <p class="avis-comment">{{ $avis->commentaire }}</p>
                </div>
            @empty
                <p class="dashboard-empty">Vous n'avez pas encore laissé d'avis.</p>
            @endforelse
        </div>

    </div>

@endsection