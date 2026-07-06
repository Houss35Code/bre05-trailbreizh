@extends('layouts.main')

@section('title', 'Randonnées en Bretagne')

@section('content')

    <!-- HERO -->
    <div class="hero">
        <h1 class="hero-title">Découvrez les plus beaux sentiers de Bretagne</h1>
        <p class="hero-subtitle">Partagez, explorez, randonnez</p>
        <form action="{{ route('randonnees.index') }}" method="GET" class="hero-form">
            <div class="hero-search-box">
                <input type="text" name="search" placeholder="Rechercher une randonnée..." class="hero-input">
                <button type="submit" class="hero-btn">Rechercher</button>
            </div>
        </form>
    </div>

    <!-- RANDONNÉES POPULAIRES -->
    <div class="popular-section">
        <h2 class="popular-title">Randonnées populaires</h2>
        <div class="popular-grid">
            @foreach($populaires as $randonnee)
                <a href="{{ route('randonnees.show', $randonnee) }}" class="card">
                    <div class="card-thumb">
                        @if($randonnee->type_terrain == 'cote') 🌊
                        @elseif($randonnee->type_terrain == 'foret') 🌿
                        @elseif($randonnee->type_terrain == 'montagne') 🏔️
                        @else 🌾
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $randonnee->titre }}</h3>
                        <div class="card-tags">
                            <span class="card-tag">{{ $randonnee->distance_km }} km</span>
                            <span class="card-tag">{{ ucfirst($randonnee->difficulte) }}</span>
                            <span class="card-tag">{{ ucfirst(str_replace('-', ' ', $randonnee->departement)) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- STATISTIQUES -->
    <div class="stats-section">
        <div class="stats-grid">
            <div>
                <div class="stat-number" data-target="{{ $nbRandonnees }}">0</div>
                <div class="stat-label">Randonnées</div>
            </div>
            <div>
                <div class="stat-number" data-target="{{ $nbMembres }}">0</div>
                <div class="stat-label">Membres</div>
            </div>
            <div>
                <div class="stat-number" data-target="{{ $nbAvis }}">0</div>
                <div class="stat-label">Avis</div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const counters = document.querySelectorAll('.stat-number');

            const animateCounter = (el) => {
                if (el.dataset.animated) return;
                el.dataset.animated = true;

                const target = +el.dataset.target;
                if (target === 0) { el.textContent = '0'; return; }

                const duration = 1500;
                const steps = 60;
                const increment = target / steps;
                let current = 0;

                const update = () => {
                    current += increment;
                    if (current < target) {
                        el.textContent = Math.floor(current);
                        requestAnimationFrame(update);
                    } else {
                        el.textContent = target;
                    }
                };
                update();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) animateCounter(entry.target);
                });
            }, { threshold: 0.3 });

            counters.forEach(counter => observer.observe(counter));
        </script>
    @endpush

@endsection