@extends('layouts.main')

@section('title', 'Admin — Randonnées')

@section('content')

    <div class="admin-container">

        <div class="admin-header">
            <h1 class="admin-page-title">Gestion des randonnées</h1>
            <a href="{{ route('admin.index') }}" class="admin-back-link">← Retour au tableau de bord</a>
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="admin-list">
            @forelse($randonnees as $randonnee)
                <div class="admin-row">
                    <div>
                        <a href="{{ route('randonnees.show', $randonnee) }}" class="admin-row-link">
                            {{ $randonnee->titre }}
                        </a>
                        <div class="admin-row-meta">
                            Par {{ $randonnee->user->name }} · {{ $randonnee->distance_km }} km ·
                            {{ ucfirst($randonnee->difficulte) }} ·
                            {{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}
                        </div>
                    </div>

                    <div class="admin-row-actions">
                        <span class="admin-badge">{{ ucfirst($randonnee->statut) }}</span>

                        {{-- Bouton Valider / Publier (si elle n'est pas déjà publiée) --}}
                        @if ($randonnee->statut !== 'publie')
                            <form method="POST" action="{{ route('admin.randonnees.valider', $randonnee) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="admin-validate-btn">
                                    Valider
                                </button>
                            </form>
                        @endif

                        {{-- Formulaire Refuser --}}
                        @if ($randonnee->statut !== 'refuse')
                            <form method="POST" action="{{ route('admin.randonnees.refuser', $randonnee) }}"
                                x-data="refuseForm" @submit="submitRefuse($event)">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="motif" x-ref="motifInput" value="">
                                <button type="submit" class="admin-refuse-btn">
                                    Refuser
                                </button>
                            </form>
                        @endif

                        {{-- Formulaire Supprimer --}}
                        <form method="POST" action="{{ route('admin.randonnees.delete', $randonnee) }}"
                            x-data="deleteForm" @submit="submitDelete($event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Aucune randonnée.</div>
            @endforelse
        </div>



    </div>

@endsection
