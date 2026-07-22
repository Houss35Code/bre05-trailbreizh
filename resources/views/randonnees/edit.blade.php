@extends('layouts.main')

@section('title', 'Modifier ma randonnée')

@section('content')

    <div class="form-container">

        <h1 class="form-page-title">Modifier ma randonnée</h1>

        <div class="form-block">

            @if($errors->any())
                <div class="form-errors">
                    <ul class="form-errors-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('randonnees.update', $randonnee) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre', $randonnee->titre) }}"
                        class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4"
                        class="form-textarea" required>{{ old('description', $randonnee->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Difficulté</label>
                    <select name="difficulte" class="form-select">
                        <option value="facile"    {{ old('difficulte', $randonnee->difficulte) == 'facile'    ? 'selected' : '' }}>Facile</option>
                        <option value="moyen"     {{ old('difficulte', $randonnee->difficulte) == 'moyen'     ? 'selected' : '' }}>Moyen</option>
                        <option value="difficile" {{ old('difficulte', $randonnee->difficulte) == 'difficile' ? 'selected' : '' }}>Difficile</option>
                        <option value="expert"    {{ old('difficulte', $randonnee->difficulte) == 'expert'    ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>

                <div class="form-grid form-group">
                    <div>
                        <label class="form-label">Distance (km)</label>
                        <input type="number" name="distance_km" value="{{ old('distance_km', $randonnee->distance_km) }}"
                            step="0.1" min="0" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Durée (minutes)</label>
                        <input type="number" name="duree_min" value="{{ old('duree_min', $randonnee->duree_min) }}"
                            step="1" min="0" class="form-input">
                    </div>
                </div>

                <div class="form-grid form-group">
                    <div>
                        <label class="form-label">Dénivelé (m)</label>
                        <input type="number" name="denivele_m" value="{{ old('denivele_m', $randonnee->denivele_m) }}"
                            step="1" min="0" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Type de terrain</label>
                        <input type="text" name="type_terrain" value="{{ old('type_terrain', $randonnee->type_terrain) }}"
                            class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Département</label>
                    <select name="departement" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="finistere"       {{ old('departement', $randonnee->departement) == 'finistere'       ? 'selected' : '' }}>Finistère (29)</option>
                        <option value="cotes-darmor"    {{ old('departement', $randonnee->departement) == 'cotes-darmor'    ? 'selected' : '' }}>Côtes-d'Armor (22)</option>
                        <option value="morbihan"        {{ old('departement', $randonnee->departement) == 'morbihan'        ? 'selected' : '' }}>Morbihan (56)</option>
                        <option value="ille-et-vilaine" {{ old('departement', $randonnee->departement) == 'ille-et-vilaine' ? 'selected' : '' }}>Ille-et-Vilaine (35)</option>
                    </select>
                </div>

                <div class="form-group-last">
                    <label class="form-label">Fichier GPX (optionnel, remplace l'existant)</label>
                    <input type="file" name="gpx" accept=".gpx,.xml">
                    <p class="photo-upload-hint">Formats acceptés : .gpx - 5 Mo max</p>
                    @if($randonnee->gpx_file)
                        <p class="photo-upload-hint">Un fichier est déjà associé ; il sera conservé si vous n'en envoyez pas de nouveau.</p>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-submit-btn">Enregistrer les modifications</button>
                    <a href="{{ route('randonnees.show', $randonnee) }}" class="form-cancel-link">Annuler</a>
                </div>

            </form>
        </div>

    </div>

@endsection