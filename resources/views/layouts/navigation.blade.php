<nav class="navbar" x-data="{ open: false }">

    <!-- BARRE PRINCIPALE -->
    <div class="nav-inner">

        <!-- Logo -->
        <a href="/" class="nav-logo">TrailBreizh</a>

        <!-- Liens navigation — desktop -->
        <div class="nav-links">
            <a href="{{ route('randonnees.index') }}" class="nav-link">Randonnées</a>
            <a href="{{ route('forum.index') }}" class="nav-link">Forum</a>
            <a href="{{ route('guides.index') }}" class="nav-link">Guides</a>
            @auth
                <a href="{{ route('randonnees.create') }}" class="nav-link">Ajouter une randonnée</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}" class="nav-admin-badge">Admin</a>
                @endif
            @endauth
        </div>

        <!-- Boutons auth — desktop -->
        <div class="nav-auth">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-btn">
                    {{ auth()->user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-btn">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                <a href="{{ route('register') }}" class="nav-btn">S'inscrire</a>
            @endauth
        </div>

        <!-- Bouton burger — mobile uniquement -->
        <button class="nav-burger" @click="open = !open">
            <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

    </div>

    <!-- MENU MOBILE -->
    <div class="nav-mobile"
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2">

        <a href="{{ route('randonnees.index') }}" class="nav-mobile-link">Randonnées</a>
        <a href="{{ route('forum.index') }}" class="nav-mobile-link">Forum</a>
        <a href="{{ route('guides.index') }}" class="nav-mobile-link">Guides</a>
        @auth
            <a href="{{ route('randonnees.create') }}" class="nav-mobile-link">Ajouter une randonnée</a>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.index') }}" class="nav-mobile-link">Admin</a>
            @endif
            <a href="{{ route('dashboard') }}" class="nav-mobile-link">Mon espace personnel</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-mobile-btn">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-mobile-link">Connexion</a>
            <a href="{{ route('register') }}" class="nav-mobile-btn">S'inscrire</a>
        @endauth
    </div>

</nav>