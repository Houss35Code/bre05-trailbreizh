<!DOCTYPE html>
<html>
<body>
    <p>Bonjour {{ $avis->user->name }},</p>

    <p>Votre avis laissé sur la randonnée « <strong>{{ $avis->randonnee->titre }}</strong> » a été signalé par un ou plusieurs membres de la communauté.</p>

    <p>Après examen, un administrateur a choisi de ne pas supprimer votre avis pour cette fois, mais souhaite vous rappeler de respecter la charte de bonne conduite de TrailBreizh (ton respectueux, pas de propos injurieux ou hors-sujet).</p>

    <p>En cas de récidive, votre compte pourra faire l'objet d'une suspension.</p>

    <p><a href="{{ route('randonnees.show', $avis->randonnee) }}">Voir la randonnée</a></p>
</body>
</html>