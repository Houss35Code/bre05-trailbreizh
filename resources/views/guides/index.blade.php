@extends('layouts.main')

@section('title', 'Guides de randonnée')

@section('content')

    <div style="max-width:1280px; margin:40px auto; padding:0 24px;">

        <h1 style="color:#1a5c38; font-size:28px; margin:0 0 32px;">Guides de randonnée</h1>

        <div class="guides-grid" style="display:grid; grid-template-columns:repeat(3, 1fr); gap:24px;">

            <!-- Guide 1 -->
            <a href="{{ route('guides.show', 'chaussures') }}" style="text-decoration:none;">
                <div style="background:white; border-radius:12px; border:1px solid #e0e0e0; overflow:hidden; transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                    <div style="background:#1a5c38; height:160px; display:flex; align-items:center; justify-content:center; font-size:64px;">
                        👟
                    </div>
                    <div style="padding:20px;">
                        <span style="background:#e8f4ed; color:#1a5c38; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;">Équipement</span>
                        <h2 style="color:#1a5c38; font-size:18px; margin:12px 0 8px;">Comment choisir ses chaussures de randonnée</h2>
                        <p style="color:#666; font-size:14px; line-height:1.6; margin:0;">Tout ce qu'il faut savoir pour choisir les bonnes chaussures selon le terrain et la saison.</p>
                    </div>
                </div>
            </a>

            <!-- Guide 2 -->
            <a href="{{ route('guides.show', 'sentiers-gr') }}" style="text-decoration:none;">
                <div style="background:white; border-radius:12px; border:1px solid #e0e0e0; overflow:hidden;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                    <div style="background:#2d7a4f; height:160px; display:flex; align-items:center; justify-content:center; font-size:64px;">
                        🗺️
                    </div>
                    <div style="padding:20px;">
                        <span style="background:#e8f4ed; color:#1a5c38; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;">Parcours</span>
                        <h2 style="color:#1a5c38; font-size:18px; margin:12px 0 8px;">Les sentiers GR en Bretagne</h2>
                        <p style="color:#666; font-size:14px; line-height:1.6; margin:0;">Découvrez les grands sentiers de randonnée qui traversent la Bretagne, du GR34 au GR380.</p>
                    </div>
                </div>
            </a>

            <!-- Guide 3 -->
            <a href="{{ route('guides.show', 'preparation') }}" style="text-decoration:none;">
                <div style="background:white; border-radius:12px; border:1px solid #e0e0e0; overflow:hidden;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                    <div style="background:#3a8a5f; height:160px; display:flex; align-items:center; justify-content:center; font-size:64px;">
                        🎒
                    </div>
                    <div style="padding:20px;">
                        <span style="background:#e8f4ed; color:#1a5c38; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;">Préparation</span>
                        <h2 style="color:#1a5c38; font-size:18px; margin:12px 0 8px;">Préparer sa randonnée en Bretagne</h2>
                        <p style="color:#666; font-size:14px; line-height:1.6; margin:0;">Conseils pratiques pour préparer au mieux votre prochaine randonnée en Bretagne.</p>
                    </div>
                </div>
            </a>

        </div>
    </div>

    @push('styles')
        <style>
            @media (max-width: 768px) {
                .guides-grid { grid-template-columns: 1fr !important; }
            }
        </style>
    @endpush

@endsection