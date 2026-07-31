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
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                        class="form-input" required
                        @error('titre') aria-describedby="titre-error" @enderror>
                    @error('titre')
                        <p id="titre-error" class="form-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="form-textarea" required
                        @error('description') aria-describedby="description-error" @enderror>{{ old('description') }}</textarea>
                    @error('description')
                        <p id="description-error" class="form-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="difficulte" class="form-label">Difficulté</label>
                    <select id="difficulte" name="difficulte" class="form-select"
                        @error('difficulte') aria-describedby="difficulte-error" @enderror>
                        <option value="facile"    {{ old('difficulte') == 'facile'    ? 'selected' : '' }}>Facile</option>
                        <option value="moyen"     {{ old('difficulte') == 'moyen'     ? 'selected' : '' }}>Moyen</option>
                        <option value="difficile" {{ old('difficulte') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                        <option value="expert"    {{ old('difficulte') == 'expert'    ? 'selected' : '' }}>Expert</option>
                    </select>
                    @error('difficulte')
                        <p id="difficulte-error" class="form-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-grid form-group">
                    <div>
                        <label for="distance_km" class="form-label">Distance (km)</label>
                        <input type="number" id="distance_km" name="distance_km" value="{{ old('distance_km') }}"
                            step="0.1" min="0" class="form-input"
                            @error('distance_km') aria-describedby="distance_km-error" @enderror>
                        @error('distance_km')
                            <p id="distance_km-error" class="form-field-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="duree_min" class="form-label">Durée (minutes)</label>
                        <input type="number" id="duree_min" name="duree_min" value="{{ old('duree_min') }}"
                            step="1" min="0" class="form-input"
                            @error('duree_min') aria-describedby="duree_min-error" @enderror>
                        @error('duree_min')
                            <p id="duree_min-error" class="form-field-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="departement" class="form-label">Département</label>
                    <select id="departement" name="departement" class="form-select"
                        @error('departement') aria-describedby="departement-error" @enderror>
                        <option value="">-- Choisir --</option>
                        <option value="finistere"       {{ old('departement') == 'finistere'       ? 'selected' : '' }}>Finistère (29)</option>
                        <option value="cotes-darmor"    {{ old('departement') == 'cotes-darmor'    ? 'selected' : '' }}>Côtes-d'Armor (22)</option>
                        <option value="morbihan"        {{ old('departement') == 'morbihan'        ? 'selected' : '' }}>Morbihan (56)</option>
                        <option value="ille-et-vilaine" {{ old('departement') == 'ille-et-vilaine' ? 'selected' : '' }}>Ille-et-Vilaine (35)</option>
                    </select>
                    @error('departement')
                        <p id="departement-error" class="form-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group-last">
                    <label for="gpx" class="form-label">Fichier GPX (optionnel)</label>
                    <input type="file" id="gpx" name="gpx" accept=".gpx,.xml" style="font-size:14px; color:#555;"
                        @error('gpx') aria-describedby="gpx-error" @enderror>
                    <p class="photo-upload-hint">Formats acceptés : .gpx - 5 Mo max</p>
                    @error('gpx')
                        <p id="gpx-error" class="form-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-submit-btn">Publier la randonnée</button>
                    <a href="{{ route('randonnees.index') }}" class="form-cancel-link">Annuler</a>
                </div>

            </form>
        </div>
    </div>

@endsection