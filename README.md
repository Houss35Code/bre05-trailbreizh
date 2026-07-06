# TrailBreizh 🥾

Application web de randonnée dédiée à la Bretagne, développée dans le cadre du titre professionnel **Développeur Web et Web Mobile** (3W Academy, 2025-2026).

TrailBreizh permet aux utilisateurs de découvrir, publier et commenter des randonnées à travers la Bretagne, avec visualisation des parcours sur carte interactive et tracé GPS.

## Fonctionnalités

- 🥾 Consultation et publication de randonnées (titre, description, difficulté, distance, dénivelé, durée, département, type de terrain)
- 🗺️ Visualisation des parcours sur carte interactive (Leaflet.js) avec affichage du tracé GPX
- ⭐ Système d'avis et de favoris sur les randonnées
- 💬 Forum communautaire (sujets et réponses)
- 🔐 Authentification et gestion des rôles utilisateurs
- 📱 Interface responsive, conçue en mobile-first

## Stack technique

**Back-end**
- PHP / Laravel
- Architecture MVC
- Base de données relationnelle (migrations, modèles Eloquent, seeders, factories)
- Sécurisation des accès par middleware et contrôle des rôles (CRUD)

**Front-end**
- Blade (moteur de templates Laravel)
- HTML sémantique / CSS (Flexbox, SASS)
- Alpine.js pour les composants interactifs (modales, menus)
- Leaflet.js + leaflet-gpx pour la cartographie et l'affichage des tracés GPX

## Installation

```bash
# Cloner le dépôt
git clone https://github.com/Houss35Code/bre05-trailbreizh.git
cd bre05-trailbreizh

# Installer les dépendances PHP
composer install

# Installer les dépendances front-end
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Configurer la base de données dans .env, puis lancer les migrations et les seeders
php artisan migrate --seed

# Compiler les assets
npm run dev

# Lancer le serveur local
php artisan serve
```

L'application est ensuite accessible sur `http://localhost:8000`.

## Auteur

**Houssouni HALIFA**
Projet réalisé dans le cadre de la formation Développeur Web et Web Mobile - 3W Academy (2025-2026)
