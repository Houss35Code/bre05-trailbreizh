@extends('layouts.main')

@section('title', 'Nouveau sujet')

@section('content')

    <div class="form-container">

        <h1 class="form-page-title">Nouveau sujet</h1>

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

            <form method="POST" action="{{ route('forum.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre') }}"
                        class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="categorie" class="form-select">
                        <option value="general"  {{ old('categorie') == 'general'  ? 'selected' : '' }}>Général</option>
                        <option value="conseils" {{ old('categorie') == 'conseils' ? 'selected' : '' }}>Conseils</option>
                        <option value="materiel" {{ old('categorie') == 'materiel' ? 'selected' : '' }}>Matériel</option>
                        <option value="parcours" {{ old('categorie') == 'parcours' ? 'selected' : '' }}>Parcours</option>
                    </select>
                </div>

                <div class="form-group-last">
                    <label class="form-label">Contenu</label>
                    <textarea name="contenu" rows="8"
                        class="form-textarea" required>{{ old('contenu') }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-submit-btn">Publier le sujet</button>
                    <a href="{{ route('forum.index') }}" class="form-cancel-link">Annuler</a>
                </div>

            </form>
        </div>
    </div>

@endsection