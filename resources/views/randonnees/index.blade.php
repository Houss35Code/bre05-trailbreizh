@extends('layouts.main')

@section('title', 'Catalogue des randonnées')

@section('content')

    <div class="catalogue-layout">

        <!-- SIDEBAR FILTRES -->
        <div class="filters-sidebar">
            <h2 class="filters-title">Filtres</h2>

            <form method="GET" action="{{ route('randonnees.index') }}">

                <div class="filter-group">
                    <label class="filter-label">Recherche</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nom de la randonnée..." class="filter-input">
                </div>

                <div class="filter-group">
                    <label class="filter-label">Département</label>
                    <select name="departement" class="filter-select">
                        <option value="">Tous les départements</option>
                        <option value="finistere" {{ request('departement') == 'finistere' ? 'selected' : '' }}>Finistère</option>
                        <option value="cotes-darmor" {{ request('departement') == 'cotes-darmor' ? 'selected' : '' }}>Côtes d'Armor</option>
                        <option value="morbihan" {{ request('departement') == 'morbihan' ? 'selected' : '' }}>Morbihan</option>
                        <option value="ille-et-vilaine" {{ request('departement') == 'ille-et-vilaine' ? 'selected' : '' }}>Ille-et-Vilaine</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Difficulté</label>
                    <select name="difficulte" class="filter-select">
                        <option value="">Toutes les difficultés</option>
                        <option value="facile" {{ request('difficulte') == 'facile' ? 'selected' : '' }}>Facile</option>
                        <option value="moyen" {{ request('difficulte') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                        <option value="difficile" {{ request('difficulte') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                        <option value="expert" {{ request('difficulte') == 'expert' ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>

                <div class="filter-group" style="margin-bottom:24px;">
                    <label class="filter-label">Type de terrain</label>
                    <select name="type_terrain" class="filter-select">
                        <option value="">Tous les terrains</option>
                        <option value="cote" {{ request('type_terrain') == 'cote' ? 'selected' : '' }}>Côte</option>
                        <option value="foret" {{ request('type_terrain') == 'foret' ? 'selected' : '' }}>Forêt</option>
                        <option value="montagne" {{ request('type_terrain') == 'montagne' ? 'selected' : '' }}>Montagne</option>
                        <option value="campagne" {{ request('type_terrain') == 'campagne' ? 'selected' : '' }}>Campagne</option>
                    </select>
                </div>

                <button type="submit" class="filter-btn">Appliquer les filtres</button>

                @if(request()->anyFilled(['search', 'departement', 'difficulte', 'type_terrain']))
                    <a href="{{ route('randonnees.index') }}" class="filter-reset">Réinitialiser les filtres</a>
                @endif

            </form>
        </div>

        <!-- LISTE DES RANDONNÉES -->
        <div>
            <div class="catalogue-header">
                <h1 class="catalogue-title">Catalogue des randonnées</h1>
                <span class="catalogue-count">{{ $randonnees->total() }} randonnée(s) trouvée(s)</span>
            </div>

            @if($randonnees->count() > 0)
                <div class="randonnees-grid">
                    @foreach($randonnees as $randonnee)
                        <div class="rando-card">
                            <div class="rando-card-thumb">
                                @if($randonnee->type_terrain == 'cote') 🌊
                                @elseif($randonnee->type_terrain == 'foret') 🌿
                                @elseif($randonnee->type_terrain == 'montagne') 🏔️
                                @else 🌾
                                @endif
                            </div>
                            <div class="rando-card-body">
                                <h3 class="rando-card-title">{{ $randonnee->titre }}</h3>
                                <div class="rando-card-tags">
                                    <span class="rando-card-tag">{{ $randonnee->distance_km }} km</span>
                                    <span class="rando-card-tag">{{ ucfirst($randonnee->difficulte) }}</span>
                                    <span class="rando-card-tag">{{ $randonnee->denivele_m }}m D+</span>
                                </div>
                                <a href="{{ route('randonnees.show', $randonnee) }}" class="rando-card-btn">
                                    Voir la randonnée
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $randonnees->links() }}
                </div>

            @else
                <div class="no-results">
                    <div class="no-results-icon">🔍</div>
                    <h3 class="no-results-title">Aucune randonnée trouvée</h3>
                    <p class="no-results-text">Essayez de modifier vos filtres de recherche.</p>
                </div>
            @endif
        </div>

    </div>

@endsection