@extends('layouts.main')

@section('title', 'Ajouter une randonnée')

@section('content')

    <div class="form-container">

        <h1 class="form-page-title">Ajouter une randonnée</h1>

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

            <form action="{{ route('randonnees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre') }}"
                        class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4"
                        class="form-textarea" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Difficulté</label>
                    <select name="difficulte" class="form-select">
                        <option value="facile"    {{ old('difficulte') == 'facile'    ? 'selected' : '' }}>Facile</option>
                        <option value="moyen"     {{ old('difficulte') == 'moyen'     ? 'selected' : '' }}>Moyen</option>
                        <option value="difficile" {{ old('difficulte') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                        <option value="expert"    {{ old('difficulte') == 'expert'    ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>

                <div class="form-grid form-group">
                    <div>
                        <label class="form-label">Distance (km)</label>
                        <input type="number" name="distance_km" value="{{ old('distance_km') }}"
                            step="0.1" min="0" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Durée (minutes)</label>
                        <input type="number" name="duree_min" value="{{ old('duree_min') }}"
                            step="1" min="0" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Département</label>
                    <select name="departement" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="finistere"       {{ old('departement') == 'finistere'       ? 'selected' : '' }}>Finistère (29)</option>
                        <option value="cotes-darmor"    {{ old('departement') == 'cotes-darmor'    ? 'selected' : '' }}>Côtes-d'Armor (22)</option>
                        <option value="morbihan"        {{ old('departement') == 'morbihan'        ? 'selected' : '' }}>Morbihan (56)</option>
                        <option value="ille-et-vilaine" {{ old('departement') == 'ille-et-vilaine' ? 'selected' : '' }}>Ille-et-Vilaine (35)</option>
                    </select>
                </div>

                <div class="form-group-last">
                    <label class="form-label">Fichier GPX (optionnel)</label>
                    <input type="file" name="gpx" accept=".gpx,.xml" style="font-size:14px; color:#555;">
                    <p class="photo-upload-hint">Formats acceptés : .gpx - 5 Mo max</p>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-submit-btn">Publier la randonnée</button>
                    <a href="{{ route('randonnees.index') }}" class="form-cancel-link">Annuler</a>
                </div>

            </form>
        </div>
    </div>

@endsection