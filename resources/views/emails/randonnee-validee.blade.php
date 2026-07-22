<!DOCTYPE html>
<html>
<body>
    <p>Bonjour {{ $randonnee->user->name }},</p>

    <p>Bonne nouvelle : votre randonnée « <strong>{{ $randonnee->titre }}</strong> » a été validée par un administrateur et est maintenant publiée sur TrailBreizh.</p>

    <p><a href="{{ route('randonnees.show', $randonnee) }}">Voir la randonnée</a></p>

    <p>Merci pour votre contribution !</p>
</body>
</html>