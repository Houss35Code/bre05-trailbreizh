@extends('layouts.main')

@section('title', 'Contact')

@section('content')

    <div class="legal-page">

        <div class="legal-breadcrumb">
            <a href="/">Accueil</a>
            &rsaquo;
            <span>Contact</span>
        </div>

        <div class="legal-card">

            <h1 class="legal-title">Contact</h1>
            <p class="contact-lead">Une question, une suggestion ou un bug à signaler ? N'hésitez pas à me contacter.</p>

            <div class="contact-cards">

                <a href="https://github.com/Houss35Code" target="_blank" rel="noopener noreferrer" class="contact-card">
                    <div class="contact-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-label">GitHub</div>
                        <div class="contact-value">github.com/Houss35Code</div>
                    </div>
                    <div class="contact-arrow">→</div>
                </a>

                <a href="mailto:houssouni.halifa@3wa.io" class="contact-card">
                    <div class="contact-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">houssouni.halifa@3wa.io</div>
                    </div>
                    <div class="contact-arrow">→</div>
                </a>

                <a href="tel:+33658491781" class="contact-card">
                    <div class="contact-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-label">Téléphone</div>
                        <div class="contact-value">06 58 49 17 81</div>
                    </div>
                    <div class="contact-arrow">→</div>
                </a>

            </div>

            <div class="contact-note">
                <p>Ce site est un projet pédagogique réalisé dans le cadre de ma formation à la <strong>3W Academy</strong>. Je suis ouvert à tout retour constructif !</p>
            </div>

        </div>
    </div>

@endsection