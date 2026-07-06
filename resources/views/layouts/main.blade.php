<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TrailBreizh') - TrailBreizh</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="site-body">

    @include('layouts.navigation')

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-links">
            <a href="{{ route('pages.mentions') }}" class="footer-link">Mentions légales</a>
            <a href="{{ route('pages.cgu') }}" class="footer-link">CGU</a>
            <a href="{{ route('pages.contact') }}" class="footer-link">Contact</a>
        </div>
        <p class="footer-copy">© 2026 TrailBreizh - Tous droits réservés</p>
    </footer>

    @stack('scripts')

</body>
</html>