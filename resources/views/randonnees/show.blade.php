@extends('layouts.main')

@section('title', $randonnee->titre)

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')

    <div class="show-container">

        <!-- FIL D'ARIANE -->
        <div class="breadcrumb">
            <a href="/" class="breadcrumb-link">Accueil</a>
            &rsaquo;
            <a href="{{ route('randonnees.index') }}" class="breadcrumb-link">Randonnées</a>
            &rsaquo;
            <span>{{ $randonnee->titre }}</span>
        </div>

        <div class="show-layout">

            <!-- COLONNE PRINCIPALE -->
            <div>

                <!-- CARTE -->
                <div id="map" class="show-map"
                    data-gpx="{{ $randonnee->gpx_file ? Storage::url($randonnee->gpx_file) : '' }}">
                </div>

                <!-- TITRE & INFOS -->
                <div class="show-block">
                    <div class="show-title-row">
                        <h1 class="show-title">{{ $randonnee->titre }}</h1>
                        @auth
                            @php
                                $estFavori = auth()->user()->favoris()->where('randonnee_id', $randonnee->id)->exists();
                            @endphp
                            @if($estFavori)
                                <form method="POST" action="{{ route('favoris.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="randonnee_id" value="{{ $randonnee->id }}">
                                    <button type="submit" class="btn-favori-remove">♥ Retirer des favoris</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('favoris.store') }}">
                                    @csrf
                                    <input type="hidden" name="randonnee_id" value="{{ $randonnee->id }}">
                                    <button type="submit" class="btn-favori-add">♡ Ajouter aux favoris</button>
                                </form>
                            @endif
                        @endauth
                    </div>

                    <!-- MÉTRIQUES -->
                    <div class="metriques-grid">
                        <div class="metrique-item">
                            <div class="metrique-value">{{ $randonnee->distance_km }} km</div>
                            <div class="metrique-label">Distance</div>
                        </div>
                        <div class="metrique-item">
                            <div class="metrique-value">{{ $randonnee->denivele_m }} m</div>
                            <div class="metrique-label">Dénivelé</div>
                        </div>
                        <div class="metrique-item">
                            <div class="metrique-value">{{ intdiv($randonnee->duree_min, 60) }}h{{ $randonnee->duree_min % 60 > 0 ? $randonnee->duree_min % 60 . 'min' : '' }}</div>
                            <div class="metrique-label">Durée</div>
                        </div>
                        <div class="metrique-item">
                            <div class="metrique-value">{{ ucfirst($randonnee->difficulte) }}</div>
                            <div class="metrique-label">Difficulté</div>
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <h2 class="show-description-title">Description</h2>
                    <p class="show-description">{{ $randonnee->description }}</p>
                </div>

                <!-- TÉLÉCHARGEMENT GPX -->
                @auth
                    <div class="show-block">
                        <h2 class="show-block-title">Fichier GPX</h2>
                        @if($randonnee->gpx_file)
                            <a href="{{ Storage::url($randonnee->gpx_file) }}" download class="gpx-btn">
                                Télécharger le GPX
                            </a>
                        @else
                            <p class="gpx-empty">Aucun fichier GPX disponible pour cette randonnée.</p>
                        @endif
                    </div>
                @else
                    <div class="gpx-alert">
                        <p class="gpx-alert-text">
                            <a href="{{ route('login') }}" class="gpx-alert-link">Connectez-vous</a>
                            pour télécharger le fichier GPX.
                        </p>
                    </div>
                @endauth

                <!-- PHOTOS -->
                <div class="show-block">
                    <h2 class="show-block-title">Photos</h2>

                    @if($randonnee->photos->count() > 0)
                        <div class="photos-grid">
                            @foreach($randonnee->photos as $photo)
                                <div class="photo-item">
                                    <img src="{{ Storage::url($photo->filename) }}"
                                        alt="{{ $photo->alt }}" class="photo-img">
                                    @auth
                                        @if(auth()->id() === $photo->user_id)
                                            <form method="POST" action="{{ route('photos.destroy', $photo) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="photo-delete-btn">✕</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="photos-empty">Aucune photo pour le moment.</p>
                    @endif

                    @auth
                        <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="randonnee_id" value="{{ $randonnee->id }}">
                            <div class="photo-upload-row">
                                <input type="file" name="photo" accept="image/*" style="font-size:14px; color:#555;">
                                <button type="submit" class="photo-upload-btn">Ajouter une photo</button>
                            </div>
                            <p class="photo-upload-hint">Formats acceptés : jpg, png, webp - 5 Mo max</p>
                        </form>
                    @endauth
                </div>

                <!-- AVIS -->
                <div class="show-block">
                    <h2 class="show-block-title">Avis de la communauté</h2>

                    @if(session('success'))
                        <div class="alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert-error">{{ session('error') }}</div>
                    @endif

                    @forelse($randonnee->avis()->with('user')->latest()->get() as $avis)
                        <div class="avis-item">
                            <div class="avis-header">
                                <div>
                                    <strong class="avis-author">{{ $avis->user->name }}</strong>
                                    <span class="avis-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $avis->note ? '⭐' : '☆' }}
                                        @endfor
                                    </span>
                                </div>
                                <div class="avis-meta">
                                    <span class="avis-date">{{ $avis->created_at->diffForHumans() }}</span>
                                    @auth
                                        @if(auth()->id() === $avis->user_id)
                                            <form method="POST" action="{{ route('avis.destroy', $avis) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="avis-delete-btn">Supprimer</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <p class="avis-text">{{ $avis->commentaire }}</p>
                        </div>
                    @empty
                        <p class="avis-empty">Aucun avis pour le moment. Soyez le premier à donner votre avis !</p>
                    @endforelse

                    @auth
                        <div class="avis-form-section">
                            <h3 class="avis-form-title">Laisser un avis</h3>
                            <form method="POST" action="{{ route('avis.store') }}">
                                @csrf
                                <input type="hidden" name="randonnee_id" value="{{ $randonnee->id }}">
                                <div class="form-group">
                                    <label class="form-label">Note</label>
                                    <select name="note" class="form-select">
                                        <option value="1">⭐ 1 - Décevant</option>
                                        <option value="2">⭐⭐ 2 - Moyen</option>
                                        <option value="3" selected>⭐⭐⭐ 3 - Bien</option>
                                        <option value="4">⭐⭐⭐⭐ 4 - Très bien</option>
                                        <option value="5">⭐⭐⭐⭐⭐ 5 - Excellent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Commentaire</label>
                                    <textarea name="commentaire" rows="3"
                                        placeholder="Partagez votre expérience..."
                                        class="form-textarea">{{ old('commentaire') }}</textarea>
                                </div>
                                <button type="submit" class="form-submit-btn">Publier mon avis</button>
                            </form>
                        </div>
                    @endauth
                </div>

            </div>

            <!-- COLONNE LATÉRALE -->
            <div>
                <div class="show-sidebar-block">
                    <h3 class="show-sidebar-title">Informations pratiques</h3>
                    <div class="info-row">
                        <div class="info-item">
                            <span class="info-label">Département</span>
                            <span class="info-value">{{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terrain</span>
                            <span class="info-value">{{ ucfirst($randonnee->type_terrain) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Difficulté</span>
                            <span class="info-value">{{ ucfirst($randonnee->difficulte) }}</span>
                        </div>
                        @if($randonnee->point_depart)
                            <div class="info-item">
                                <span class="info-label">Point de départ</span>
                                <span class="info-value">{{ $randonnee->point_depart }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('randonnees.index') }}" class="btn-back">← Retour au catalogue</a>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapEl = document.getElementById('map');
            const gpxUrl = mapEl.dataset.gpx;

            const map = L.map('map').setView([48.2, -2.9], 8);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            if (gpxUrl) {
                fetch(gpxUrl)
                    .then(r => r.text())
                    .then(gpxText => {
                        const parser = new DOMParser();
                        const gpx = parser.parseFromString(gpxText, 'application/xml');
                        const points = Array.from(gpx.querySelectorAll('trkpt')).map(pt => [
                            parseFloat(pt.getAttribute('lat')),
                            parseFloat(pt.getAttribute('lon'))
                        ]);
                        if (points.length > 0) {
                            const polyline = L.polyline(points, { color: '#1a5c38', weight: 3 }).addTo(map);
                            map.fitBounds(polyline.getBounds());
                        }
                    })
                    .catch(() => {});
            }
        });
    </script>
@endpush