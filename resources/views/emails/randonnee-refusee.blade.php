<!DOCTYPE html>
<html>
<body>
    <p>Bonjour {{ $randonnee->user->name }},</p>

    <p>Votre randonnée « <strong>{{ $randonnee->titre }}</strong> » n'a pas été validée par un administrateur.</p>

    <p><strong>Motif :</strong> {{ $randonnee->motif_refus }}</p>

    <p>Vous pouvez modifier votre randonnée et la soumettre à nouveau.</p>

    <p><a href="{{ route('randonnees.edit', $randonnee) }}">Modifier ma randonnée</a></p>
</body>
</html>