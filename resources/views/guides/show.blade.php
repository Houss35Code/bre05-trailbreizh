@extends('layouts.main')

@section('title', $guide['titre'])

@section('content')

    <div style="max-width:900px; margin:40px auto; padding:0 24px;">

        <!-- FIL D'ARIANE -->
        <div style="margin-bottom:20px; font-size:13px; color:#888;">
            <a href="/" style="color:#1a5c38; text-decoration:none;">Accueil</a>
            &rsaquo;
            <a href="{{ route('guides.index') }}" style="color:#1a5c38; text-decoration:none;">Guides</a>
            &rsaquo;
            <span>{{ $guide['titre'] }}</span>
        </div>

        <div style="background:white; border-radius:12px; padding:40px; border:1px solid #e0e0e0;">

            <!-- EN-TÊTE -->
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                <span style="background:#e8f4ed; color:#1a5c38; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;">
                    {{ $guide['categorie'] }}
                </span>
                <span style="color:#aaa; font-size:13px;">{{ $guide['temps_lecture'] }} de lecture</span>
            </div>

            <div style="font-size:48px; margin-bottom:12px;">{{ $guide['icone'] }}</div>

            <h1 style="color:#1a5c38; font-size:28px; margin:0 0 24px;">{{ $guide['titre'] }}</h1>

            <!-- INTRODUCTION -->
            <p style="color:#555; font-size:16px; line-height:1.8; margin:0 0 32px; padding-bottom:24px; border-bottom:1px solid #eee;">
                {{ $contenu['intro'] }}
            </p>

            <!-- SECTIONS -->
            @foreach ($contenu['sections'] as $section)
                <div style="margin-bottom:28px;">
                    <h2 style="color:#1a5c38; font-size:19px; margin:0 0 10px;">
                        {{ $section['titre'] }}
                    </h2>
                    <div style="color:#444; font-size:15px; line-height:1.6;">{!! nl2br(preg_replace('/\n{2,}/', "\n", $section['contenu'])) !!}</div>
                </div>
            @endforeach

            <!-- CONSEIL EXPERT -->
            @if (!empty($contenu['conseil_expert']))
                <div style="background:#e8f4ed; border-left:4px solid #1a5c38; border-radius:0 8px 8px 0; padding:16px 20px; margin:32px 0;">
                    <div style="color:#1a5c38; font-weight:600; font-size:13px; margin-bottom:6px;">💡 Conseil expert</div>
                    <p style="color:#1a5c38; font-size:15px; line-height:1.7; margin:0;">{{ $contenu['conseil_expert'] }}</p>
                </div>
            @endif

            <!-- GUIDES SUGGÉRÉS -->
            @if (!empty($guidesSuggeres))
                <div style="margin-top:40px; padding-top:24px; border-top:1px solid #eee;">
                    <h3 style="color:#333; font-size:16px; margin:0 0 16px;">Autres guides</h3>
                    <div style="display:flex; gap:16px;">
                        @foreach ($guidesSuggeres as $suggestion)
                            <a href="{{ route('guides.show', $suggestion['slug']) }}"
                               style="flex:1; background:#f5f5f0; border-radius:8px; padding:16px; text-decoration:none; border:1px solid #e0e0e0;">
                                <div style="font-size:28px; margin-bottom:8px;">{{ $suggestion['icone'] }}</div>
                                <div style="color:#1a5c38; font-size:14px; font-weight:600; line-height:1.4;">{{ $suggestion['titre'] }}</div>
                                <div style="color:#888; font-size:12px; margin-top:4px;">{{ $suggestion['temps_lecture'] }} de lecture</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- RETOUR -->
            <div style="margin-top:32px; padding-top:24px; border-top:1px solid #eee;">
                <a href="{{ route('guides.index') }}" style="color:#1a5c38; text-decoration:none; font-weight:600;">
                    ← Retour aux guides
                </a>
            </div>

        </div>
    </div>

@endsection